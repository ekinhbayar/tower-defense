<?php declare(strict_types=1);

namespace Game\Examples;

use Game\Map\Generator\Generator;

require_once __DIR__ . '/../vendor/autoload.php';

$generator = new Generator();

$map = $generator->generate(1200, 800, 20, 12);

//var_dump($map->getAsArray());

var_dump(json_encode($map->getAsArray()));
