<?php declare(strict_types = 1);

namespace Game\Entity\Player;

use Game\Entity\Buyable;
use Game\Entity\Enemy;
use Game\Entity\Player;

class FundManager
{
    /**
     * @param \Game\Entity\Buyable $towerOrWalker
     * @param \Game\Entity\Player  $player
     */
    public function processSale(Buyable $towerOrWalker, Player $player)
    {
        $player->setFunds($player->getFunds() - $towerOrWalker->getUnitPrice());
    }

    /**
     * Player reward per enemy defeat is equal to enemy hit points (temporary)
     *
     * @param \Game\Entity\Enemy  $enemy
     * @param \Game\Entity\Player $player
     */
    public function processEnemyDefeat(Enemy $enemy, Player $player)
    {
        $player->setFunds($player->getFunds() + $enemy->getHitPoints());
    }
}
