<?php
use BattleSimulator\AbstractCombatant;
use BattleSimulator\CombatantInterface;

class Combatant extends AbstractCombatant
{
    public function getGenerator() {}

    public function missed(CombatantInterface $attacker) {}

    public function attack(CombatantInterface $opponent) {}
}

class AbstractCombatantTest extends \PHPUnit_Framework_TestCase
{
    public function testSetCombatantName()
    {
        $combatantName = "Combatant Name";
        $combatant = new Combatant();
        $combatant->setName($combatantName);
        $this->assertEquals($combatant->getName(), $combatantName);
    }

    public function validHealthProvider()
    {
        return [
            [0],
            [1],
            [99],
            [100]
        ];
    }

    public function invalidHealthProvider()
    {
        return [
            [-10],
            [101],
            ["unlimited"],
            [50.1]
        ];
    }

    /**
     * @dataProvider validHealthProvider
     */
    public function testSetCombatantHealth($combatantHealth)
    {
        $combatant = new Combatant();
        $combatant->setHealth($combatantHealth);
        $this->assertEquals($combatant->getHealth(), $combatantHealth);
    }

    /**
     * @dataProvider invalidHealthProvider
     * @expectedException RuntimeException
     */
    public function testSetCombatantInvalidHealth($combatantHealth)
    {
        $combatant = new Combatant();
        $combatant->setHealth($combatantHealth);
        $this->assertEquals($combatant->getHealth(), $combatantHealth);
    }
}
