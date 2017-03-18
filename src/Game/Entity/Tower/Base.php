<?php declare(strict_types=1);

namespace Game\Entity\Tower;

use Game\Entity\Tower;

class Base extends Tower
{
    public function __construct(int $id)
    {
        parent::__construct($id, 50, 4000);
    }
}
