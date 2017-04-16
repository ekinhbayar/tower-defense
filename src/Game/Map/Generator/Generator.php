<?php declare(strict_types = 1);

namespace Game\Map\Generator;

class Generator
{
    public function generate(int $width, int $height, int $tileSize, int $numberOfPlayer)
    {
        $spawnPoint = (new Spawn($width, $height))->generate();
        $players    = (new Players(new Player($width, $height)))->generate($numberOfPlayer);
        $paths      = (new Path($width, $height, $tileSize))->generate($players, $spawnPoint);
    }
}
