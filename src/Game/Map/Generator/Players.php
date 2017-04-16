<?php declare(strict_types = 1);

namespace Game\Map\Generator;

use Game\Entity\Coordinates;

/**
 * Rules:
 *
 * - Draws players positions at a random place somewhere at the edge of the map
 * - Players must not be right next to each other
 *
 * Implementation:
 *
 * - Generate new player position
 * - Check whether the distance is not too close to other players (minimum 100 pixels or 5 tiles space)
 * - If player is too close to already existing players: regenerate
 */
class Players
{
    const MINIMUM_SPACING = 100;

    private $players = [];

    private $playerGenerator;

    public function __construct(Player $playerGenerator)
    {
        $this->playerGenerator = $playerGenerator;
    }

    public function generate(int $numberOfPlayers): array
    {
        while ($numberOfPlayers) {
            $player = $this->playerGenerator->generate();

            if (!$this->isPlayerPositionAllowed($player)) {
                continue;
            }

            $this->players[] = $player;

            $numberOfPlayers--;
        }

        return $this->players;
    }

    private function isPlayerPositionAllowed(Coordinates $player): bool
    {
        foreach ($this->players as $existingPlayer) {
            if (!$this->isPlayerPositionAllowedAgainstExistingPlayer($player, $existingPlayer)) {
                return false;
            }
        }

        return true;
    }

    private function isPlayerPositionAllowedAgainstExistingPlayer(Coordinates $newPlayer, Coordinates $existingPlayer): bool
    {
        $minimumX = $newPlayer->getX() - self::MINIMUM_SPACING;
        $maximumX = $newPlayer->getX() + self::MINIMUM_SPACING;
        $minimumY = $newPlayer->getY() - self::MINIMUM_SPACING;
        $maximumY = $newPlayer->getY() + self::MINIMUM_SPACING;

        if ($existingPlayer->getX() < $minimumX) {
            return true;
        }

        if ($existingPlayer->getX() > $maximumX) {
            return true;
        }

        if ($existingPlayer->getY() < $minimumY) {
            return true;
        }

        if ($existingPlayer->getY() > $maximumY) {
            return true;
        }

        return false;
    }
}
