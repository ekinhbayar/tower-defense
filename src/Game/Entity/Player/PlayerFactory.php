<?php declare(strict_types = 1);

namespace Game\Entity\Player;

use Game\Entity\Player;
use Game\Entity\Towers;
use Game\Entity\Tower\Factory;
use Game\Entity\Coordinates;

class PlayerFactory
{
    private $lastPlayerId = -1;

    public function build(string $name, Coordinates $coordinates): Player
    {
        $this->lastPlayerId++;

        $base = (new Factory())->build("Base", $coordinates);

        return new Player($this->lastPlayerId, $name, $base, new Towers(new Factory()), $coordinates);
    }
}
