<?php declare(strict_types = 1);

namespace Game\Map\Generator;

use Game\Entity\Coordinates;
use Game\Entity\Map\Path as PathTile;

/**
 * Rules:
 *
 * - Drawing a path from point a to point b
 * - Tiles must be placed random
 * - Tiles must be connected
 * - New tiles must be biased to point b
 * - No paths along the edges of the map
 * - There must be no tiles next to each other unless it's an intersection
 *
 * Implementation:
 *
 * - Individual paths are generated from the spawn point to each player
 * - Each direction (for new tile placement) has a 25% chance of being hit by default
 * - Each direction (for new tile placement) is biased towards the player's position
 * - Each direction (for new tile placement) is biased towards positions not yet in eth path to the player
 * - Tiles are not allowed to touch the edges
 * - Tiles are not allowed to go outside the map
 */
class Path
{
    const BIAS = 20;

    private $path = [];

    private $width;

    private $height;

    private $tileSize;

    public function __construct(int $width, int $height, int $tileSize)
    {
        $this->width    = $width;
        $this->height   = $height;
        $this->tileSize = $tileSize;
    }

    public function generate(array $players, Coordinates $spawnPoint)
    {
        while ($player = array_shift($players)) {
            $this->generatePathToPlayer($player, $spawnPoint);
        }

        return $this->path;
    }

    private function generatePathToPlayer(Coordinates $player, Coordinates $spawnPoint)
    {
        $playerPath = [];

        $pathTile = new PathTile(
            new Coordinates($spawnPoint->getX(), $spawnPoint->getY())
        );

        $playerPath[$this->convertTileToKey($pathTile)] = $pathTile;

        while ($pathTile->getPositionX() !== $player->getX() || $pathTile->getPositionY() !== $player->getY()) {
            $pathTile = $this->getNextTile($playerPath, $pathTile, $player);

            $playerPath[$this->convertTileToKey($pathTile)] = $pathTile;

            $this->path = array_merge($this->path, $playerPath);
        }
    }

    private function convertTileToKey(PathTile $tile): string
    {
        return $tile->getPositionX() . 'x' . $tile->getPositionY();
    }

    private function getNextTile(array $playerPath, PathTile $currentTile, Coordinates $player): PathTile
    {
        // base chance of hitting a certain direction
        $possibilities = [
            'top'    => 25,
            'bottom' => 25,
            'left'   => 25,
            'right'  => 25,
        ];

        $possibilities = $this->biasTowardsPlayer($possibilities, $currentTile, $player);
        $possibilities = $this->biasTowardsNewTiles($possibilities, $currentTile, $playerPath);
        $possibilities = $this->removeChanceOfHittingTheEdge($possibilities, $currentTile, $player);
        $possibilities = $this->removeChanceOfGoingOutsideTheMap($possibilities, $currentTile);
        $possibilities = $this->removeChanceOfIntroducingBlocks($possibilities, $currentTile);

        $newDirection = random_int(0, array_sum($possibilities));

        $currentChance = 0;

        foreach ($possibilities as $direction => $possibility) {
            $currentChance += $possibility;

            if ($newDirection <= $currentChance) {
                return $this->getTileCoordinatesBasedOnDirectionAndPreviousTile($direction, $currentTile);
            }
        }
    }

    private function biasTowardsPlayer(array $chances, PathTile $currentTile, Coordinates $player): array
    {
        if ($player->getX() < $currentTile->getPositionX()) {
            $chances['left'] += self::BIAS;
        }

        if ($player->getX() > $currentTile->getPositionX()) {
            $chances['right'] += self::BIAS;
        }

        if ($player->getY() < $currentTile->getPositionY()) {
            $chances['top'] += self::BIAS;
        }

        if ($player->getY() > $currentTile->getPositionY()) {
            $chances['bottom'] += self::BIAS;
        }

        return $chances;
    }

    private function biasTowardsNewTiles(array $chances, PathTile $currentTile, array $playerPath): array
    {
        if ($this->tileExists($currentTile->moveLeft(), $playerPath)) {
            $chances['left'] -= self::BIAS;
        }

        if ($this->tileExists($currentTile->moveRight(), $playerPath)) {
            $chances['right'] -= self::BIAS;
        }

        if ($this->tileExists($currentTile->moveUp(), $playerPath)) {
            $chances['top'] -= self::BIAS;
        }

        if ($this->tileExists($currentTile->moveDown(), $playerPath)) {
            $chances['bottom'] -= self::BIAS;
        }

        return $chances;
    }

    private function removeChanceOfHittingTheEdge(array $chances, PathTile $currentTile, Coordinates $player): array
    {
        $newTile = $currentTile->moveLeft();

        if ($newTile->getPositionX() === 0 && ($newTile->getPositionX() !== $player->getX() || $newTile->getPositionY() !== $player->getY())) {
            $chances['left'] = 0;
        }

        $newTile = $currentTile->moveRight();

        if ($newTile->getPositionX() === 1180 && ($newTile->getPositionX() !== $player->getX() || $newTile->getPositionY() !== $player->getY())) {
            $chances['right'] = 0;
        }

        $newTile = $currentTile->moveUp();

        if ($newTile->getPositionY() === 0 && ($newTile->getPositionX() !== $player->getX() || $newTile->getPositionY() !== $player->getY())) {
            $chances['top'] = 0;
        }

        $newTile = $currentTile->moveDown();

        if ($newTile->getPositionY() === 780 && ($newTile->getPositionX() !== $player->getX() || $newTile->getPositionY() !== $player->getY())) {
            $chances['bottom'] = 0;
        }

        return $chances;
    }

    private function removeChanceOfGoingOutsideTheMap(array $chances, PathTile $currentTile): array
    {
        $newTile = $currentTile->moveLeft();

        if ($newTile->getPositionX() < 0) {
            $chances['left'] = 0;
        }

        $newTile = $currentTile->moveRight();

        if ($newTile->getPositionX() > 1180) {
            $chances['right'] = 0;
        }

        $newTile = $currentTile->moveUp();

        if ($newTile->getPositionY() < 0) {
            $chances['top'] = 0;
        }

        $newTile = $currentTile->moveDown();

        if ($newTile->getPositionY() > 780) {
            $chances['bottom'] = 0;
        }

        return $chances;
    }

    private function removeChanceOfIntroducingBlocks(array $chances, PathTile $currentTile): array
    {
        $upTile    = $currentTile->moveUp();
        $downTile  = $currentTile->moveDown();
        $leftTile  = $currentTile->moveLeft();
        $rightTile = $currentTile->moveRight();

        $chances['top']    -= (int) ($this->getNumberOfNeighbors($upTile) / 2);
        $chances['bottom'] -= (int) ($this->getNumberOfNeighbors($downTile) / 2);
        $chances['left']   -= (int) ($this->getNumberOfNeighbors($leftTile) / 2);
        $chances['right']  -= (int) ($this->getNumberOfNeighbors($rightTile) / 2);

        return $chances;
    }

    private function getNumberOfNeighbors(PathTile $tile): int
    {
        $neighbors = 0;

        $upTile    = $tile->moveUp();
        $downTile  = $tile->moveDown();
        $leftTile  = $tile->moveLeft();
        $rightTile = $tile->moveRight();

        if (array_key_exists($this->convertTileToKey($upTile), $this->path)) {
            $neighbors++;
        }

        if (array_key_exists($this->convertTileToKey($downTile), $this->path)) {
            $neighbors++;
        }

        if (array_key_exists($this->convertTileToKey($leftTile), $this->path)) {
            $neighbors++;
        }

        if (array_key_exists($this->convertTileToKey($rightTile), $this->path)) {
            $neighbors++;
        }

        return $neighbors;
    }

    private function tileExists(PathTile $tile, array $playerPath): bool
    {
        $key = $this->convertTileToKey($tile);

        if (array_key_exists($key, $playerPath)) {
            return true;
        }

        return false;
    }

    private function getTileCoordinatesBasedOnDirectionAndPreviousTile(string $direction, PathTile $currentTile): PathTile
    {
        switch ($direction) {
            case 'top':
                return $currentTile->moveUp();

            case 'bottom':
                return $currentTile->moveDown();

            case 'left':
                return $currentTile->moveLeft();

            case 'right':
                return $currentTile->moveRight();
        }
    }
}
