<?php
namespace BattleSimulator\Skill;

use BattleSimulator\CombatantInterface;

interface SkillInterface
{
    /**
     * Returns combatant's object.
     *
     * @return CombatantInterface
     */
    public function getCombatant();

    /**
     * Check if the attacker missed attack
     *
     * @param CombatantInterface $attacker
     * @return boolean
     */
    public function missed(CombatantInterface $attacker);

    /**
     * Executes combatant's attack againt opponent.
     *
     * @param CombatantInterface $opponent Combatant being attacked.
     * @return boolean
     */
    public function attack(CombatantInterface $opponent);
}
