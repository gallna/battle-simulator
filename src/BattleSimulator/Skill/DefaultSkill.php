<?php
namespace BattleSimulator\Skill;

use BattleSimulator\CombatantInterface;

class DefaultSkill implements SkillInterface
{
    /**
     * @var Combatant
     */
    private $combatant;

    public function __construct(CombatantInterface $combatant)
    {
        $this->combatant = $combatant;
    }

    /**
     * {@inheritdoc}
     */
    public function getCombatant()
    {
        return $this->combatant;
    }

    /**
     * Check if the attacker missed attack
     *
     * @param CombatantInterface $attacker
     * @return boolean
     */
    public function missed(CombatantInterface $attacker)
    {
        return $this->getCombatant()->getLuck() >= rand(1, 10) / 10;
    }

    /**
     * Executes combatant's attack againt opponent.
     *
     * @param CombatantInterface $defender Combatant being attacked.
     * @return boolean
     */
    public function attack(CombatantInterface $defender)
    {
        if (!$defender->missed($this->getCombatant())) {
            return $this->getCombatant()->getStrength() - $defender->getDefence();
        }
        return 0;
    }
}
