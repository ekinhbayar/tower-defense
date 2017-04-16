<?php declare(strict_types = 1);

namespace Game\Map\Generator;

use Game\Entity\Coordinates;

/**
 * Rules:
 *
 * - Drawing a spawn point at a random place somewhere in the center of the map
 *
 * Implementation:
 *
 * - Spawns can only be placed at the center of the map
 * - The possible spawn points are somewhere in a square based on 1/5 of the height and width of the map
 */
class Spawn
{
    private $x;

    private $y;

    public function __construct(int $width, int $height)
    {
        $widthParts  = (int) ($width / 5);
        $heightParts = (int) ($height / 5);

        $this->x = [
            $widthParts * 2,
            $widthParts * 3,
        ];

        $this->y = [
            $heightParts * 2,
            $heightParts * 3,
        ];
    }

    public function generate(): Coordinates
    {
        return new Coordinates(
            random_int(...$this->snapToGrid($this->x)) * 20,
            random_int(...$this->snapToGrid($this->y)) * 20
        );
    }

    private function snapToGrid(array $positions): array
    {
        $modStart = $positions[0] % 20;
        $modEnd   = $positions[1] % 20;

        return [
            ($positions[0] + ($modStart < (20 / 2) ? -$modStart : 20 - $modStart)) / 20,
            ($positions[1] + ($modEnd < (20 / 2) ? -$modEnd : 20 - $modEnd)) / 20,
        ];
    }
}
