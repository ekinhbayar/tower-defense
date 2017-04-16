<?php declare(strict_types=1);

namespace Game\Examples;

use Game\Entity\Coordinates;
use Game\Map\Generator\Path;

require_once __DIR__ . '/../vendor/autoload.php';

$pathGenerator = new Path(1200, 800, 20);

$path = [];

foreach ($pathGenerator->generate([new Coordinates(200, 0)], new Coordinates(500, 500)) as $tile) {
    $path[] = [
        'x' => $tile->getPositionX(),
        'y' => $tile->getPositionY(),
    ];
}

var_dump(json_encode($path));
