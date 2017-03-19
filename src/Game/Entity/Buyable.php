<?php declare(strict_types = 1);

namespace Game\Entity;

interface Buyable
{
    public function getUnitPrice(): int;
}
