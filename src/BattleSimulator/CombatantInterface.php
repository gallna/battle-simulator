<?php
namespace BattleSimulator;

interface CombatantInterface
{
    /**
     * Returns combatant's name.
     *
     * @return string
     */
    public function getName();

    /**
     * Returns combatant's health.
     *
     * @return integer
     */
    public function getHealth();

    /**
     * Used to reduce combatant's health in the event of an attck.
     *
     * @param integer $damage Damage done to combatant's health.
     * @return Combatant
     */
    public function reduceHealth($damage);

    /**
     * Returns combatant's strength.
     *
     * @return integer
     */
    public function getStrength();

    /**
     * Returns combatant's defence.
     *
     * @return integer
     */
    public function getDefence();

    /**
     * Returns combatant's speed.
     *
     * @return integer
     */
    public function getSpeed();

    /**
     * Returns combatant's luck.
     *
     * @return float
     */
    public function getLuck();

    /**
     * Returns Combatant's skill generator
     *
     * @return Generator
     */
    public function getGenerator();

    /**
     * Check if the attacker missed attack
     *
     * @param CombatantInterface $attacker
     * @return boolean
     */
    public function missed(CombatantInterface $attacker);

    /**
     * Executes combatant's attack againt opponent. Method returns demage
     *
     * @param CombatantInterface $opponent Combatant being attacked.
     * @return integer
     */
    public function attack(CombatantInterface $opponent);
}
