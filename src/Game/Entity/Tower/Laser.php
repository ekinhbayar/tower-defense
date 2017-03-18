<?php declare(strict_types=1);

namespace Game\Entity\Tower;

use Game\Entity\Tower;

class Laser extends Tower
{
    public function __construct(int $id)
    {
        parent::__construct($id, 100, 2000);
    }
}
