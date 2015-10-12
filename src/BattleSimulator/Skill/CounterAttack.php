<?php
namespace BattleSimulator\Skill;

use BattleSimulator\CombatantInterface;

/**
 * When a grappler evades an attack their opponent is dealt 10 damage
 */
class CounterAttack extends DefaultSkill
{
    const COUNTER_ATTACK_DAMAGE = 10;

    /**
     * {@inheritdoc}
     */
    public function missed(CombatantInterface $attacker)
    {
        if ($missed = parent::missed($attacker)) {
            $attacker->reduceHealth(self::COUNTER_ATTACK_DAMAGE);
        }
        return $missed;
    }
}
