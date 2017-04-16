<?php declare(strict_types = 1);

namespace Game\Map;

use Game\Entity\Coordinates;

class Map
{
    private $spawnPoint;

    private $players;

    private $paths;

    public function __construct(Coordinates $spawnPoint, array $players, array $paths)
    {
        $this->spawnPoint = $spawnPoint;
        $this->players    = $players;
        $this->paths      = $paths;
    }

    public function getAsArray(): array
    {
        return [
            'spawn'  => $this->spawnPoint->getAsArray(),
            'player' => [
                'id'    => 1,
                'token' => 'ewiy4734y7ed',
            ],
            'players' => $this->getPlayersAsArray(),
            'path'    => $this->getPathAsArray(),
        ];
    }

    private function getPlayersAsArray(): array
    {
        $players = [];

        foreach ($this->players as $index => $player) {
            $players[] = [
                'id'   => $index + 1,
                'name' => 'Player ' . $index,
                'x'    => $player->getX(),
                'y'    => $player->getY(),
            ];
        }

        return $players;
    }

    private function getPathAsArray(): array
    {
        $path = [];

        foreach ($this->paths as $pathTile) {
            $path[] = [
                'x' => $pathTile->getPositionX(),
                'y' => $pathTile->getPositionY(),
            ];
        }

        return $path;
    }
}
