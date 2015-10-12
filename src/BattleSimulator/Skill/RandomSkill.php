<?php
namespace BattleSimulator\Skill;

use BattleSimulator\CombatantInterface;

/**
 * With each attack there is a 2% chance of stunning the enemy, causing them
 * to miss their next attack.
 */
abstract class RandomSkill extends DefaultSkill implements RandomSkillInterface
{
    /**
     * {@inheritdoc}
     */
    public function draw($rand)
    {
        return $rand >= (100 - $this->getChance());
    }

    /**
     * Returns draw chance 0-100
     *
     * @return integer
     */
    abstract public function getChance();
}
