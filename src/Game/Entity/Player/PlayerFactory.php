<?php declare(strict_types = 1);

namespace Game\Entity\Player;

use Game\Entity\Player;
use Game\Entity\Towers;
use Game\Entity\Tower\Factory;
use Game\Entity\Coordinates;

class PlayerFactory
{
    private $lastPlayerId = -1;

    private $towerFactory;

    public function __construct(Factory $towerFactory)
    {
        $this->towerFactory = $towerFactory;
    }

    public function build(string $name, Coordinates $coordinates): Player
    {
        $this->lastPlayerId++;

        return new Player(
            $this->lastPlayerId,
            $name,
            $this->towerFactory->build('Base', $coordinates),
            new Towers($this->towerFactory),
            $coordinates
        );
    }
}
