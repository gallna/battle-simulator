<?php
namespace BattleSimulator;

interface BattlerInterface extends CombatantInterface
{
    /**
     * @return Generator
     */
    public function getGenerator();

    /**
     * Check if the attacker missed attack
     *
     * @param BattlerInterface $attacker
     * @return boolean
     */
    public function missed(BattlerInterface $attacker);

    /**
     * Executes combatant's attack againt opponent. Method returns demage
     *
     * @param BattlerInterface $opponent Combatant being attacked.
     * @return integer
     */
    public function attack(BattlerInterface $opponent);
}
