<?php
use BattleSimulator\Skill\DefaultSkill;

class DefaultSkillTest extends \PHPUnit_Framework_TestCase
{
    public function testMissedActionWithLuck0()
    {
        $attackerMock = $this->getMock('BattleSimulator\CombatantInterface');
        $defenderMock = $this->getMock('BattleSimulator\CombatantInterface');
        $defenderMock->expects($this->once())
            ->method('getLuck')
            ->will($this->returnValue(0));
        $skill = new DefaultSkill($defenderMock);
        $this->assertFalse($skill->missed($attackerMock));
    }

    public function testMissedActionWithLuck1()
    {
        $attackerMock = $this->getMock('BattleSimulator\CombatantInterface');
        $defenderMock = $this->getMock('BattleSimulator\CombatantInterface');
        $defenderMock->expects($this->once())
            ->method('getLuck')
            ->will($this->returnValue(1));
        $skill = new DefaultSkill($defenderMock);
        $this->assertTrue($skill->missed($attackerMock));
    }

    public function testAttackActionWithLuck1()
    {
        $attackerMock = $this->getMock('BattleSimulator\CombatantInterface');
        $attackerMock->expects($this->never())
            ->method('getStrength');
        $defenderMock = $this->getMock('BattleSimulator\CombatantInterface');
        $defenderMock->expects($this->once())
            ->method('missed')
            ->will($this->returnValue(true));
        $skill = new DefaultSkill($attackerMock);
        $this->assertEquals(0, $skill->attack($defenderMock));
    }

    public function testAttackActionWithLuck0()
    {
        $damage = 10;
        $attackerMock = $this->getMock('BattleSimulator\CombatantInterface');
        $attackerMock->expects($this->once())
            ->method('getStrength')
            ->will($this->returnValue($damage));
        $defenderMock = $this->getMock('BattleSimulator\CombatantInterface');
        $defenderMock->expects($this->once())
            ->method('missed')
            ->will($this->returnValue(false));
        $skill = new DefaultSkill($attackerMock);
        $this->assertEquals($damage, $skill->attack($defenderMock));
    }

    public function testAttackActionWithLuck0Defence5()
    {
        $damage = 10;
        $defense = 5;
        $attackerMock = $this->getMock('BattleSimulator\CombatantInterface');
        $attackerMock->expects($this->once())
            ->method('getStrength')
            ->will($this->returnValue($damage));
        $defenderMock = $this->getMock('BattleSimulator\CombatantInterface');
        $defenderMock->expects($this->once())
            ->method('missed')
            ->will($this->returnValue(false));
        $defenderMock->expects($this->once())
            ->method('getDefence')
            ->will($this->returnValue($defense));
        $skill = new DefaultSkill($attackerMock);
        $this->assertEquals($damage - $defense, $skill->attack($defenderMock));
    }
}
