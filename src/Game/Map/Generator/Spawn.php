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
            'start' => $widthParts * 2,
            'end'   => $widthParts * 3,
        ];

        $this->y = [
            'start' => $heightParts * 2,
            'end'   => $heightParts * 3,
        ];
    }

    public function generate(): Coordinates
    {
        return new Coordinates(random_int(...$this->x), random_int(...$this->y));
    }
}
