<?php declare(strict_types = 1);

namespace Game\Map\Generator;

use Game\Entity\Coordinates;

/**
 * Rules:
 *
 * - Drawing a player position at a random place somewhere at the edge of the map
 *
 * Implementation:
 *
 * - First determine what edge (top, bottom, left, right) the player will be placed
 * - Place the player at a random position on the chosen edge
 * - Players cannot be placed in the exact corners (e.g. 0x0 etc)
 */
class Player
{
    const EDGES = [
        'top',
        'bottom',
        'left',
        'right',
    ];

    private $width;

    private $height;

    public function __construct(int $width, int $height)
    {
        $this->width  = $width / 20;
        $this->height = $height / 20;
    }

    public function generate(): Coordinates
    {
        $edge = self::EDGES[random_int(0, 3)];

        return $this->getPositionAlongEdge($edge);
    }

    private function getPositionAlongEdge(string $edge): Coordinates
    {
        switch ($edge) {
            case 'top':
                return new Coordinates(random_int(1, $this->width - 1) * 20, 0);

            case 'bottom':
                return new Coordinates(random_int(1, $this->width - 1) * 20, ($this->height - 1) * 20);

            case 'left':
                return new Coordinates(0, random_int(1, $this->height - 1) * 20);

            case 'right':
                return new Coordinates(($this->width - 1) * 20, random_int(1, $this->height - 1) * 20);
        }
    }
}
