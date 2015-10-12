<?php
namespace BattleSimulator\Skill;

use BattleSimulator\Battler as Combatant;

/**
 * With each attack there is a 5% chance of their strength doubling for that attack
 */
class LuckyStrike extends RandomSkill
{
    const LUCKY_STRIKE_CHANCE = 5;

    /**
     * {@inheritdoc}
     */
    public function getChance()
    {
        return self::LUCKY_STRIKE_CHANCE;
    }

    /**
     * {@inheritdoc}
     */
    public function attack(Combatant $defender)
    {
        if (!$defender->missed($this)) {
            return ($this->getCombatant()->getStrength() * 2) - $defender->getCombatant()->getDefence();
        }
        return 0;
    }
}
