<?php
namespace BattleSimulator\Skill;

use BattleSimulator\CombatantInterface;

class StunnedCombatant extends DefaultSkill
{
    /**
     * {@inheritdoc}
     */
    public function attack(CombatantInterface $opponent)
    {
        return 0;
    }
}
