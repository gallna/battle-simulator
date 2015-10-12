<?php
use BattleSimulator\Skill\DefaultSkill;

class RandomSkillTest extends \PHPUnit_Framework_TestCase
{
    public function testDrawWithRand100()
    {
        $mock = $this->getMock('BattleSimulator\CombatantInterface');
        $stub = $this->getMockForAbstractClass('BattleSimulator\Skill\RandomSkill', [$mock]);

        $stub->expects($this->any())
             ->method('getChance')
             ->will($this->returnValue(100));

        $this->assertTrue($stub->draw(100));
    }

    public function testDrawWithRand0()
    {
        $mock = $this->getMock('BattleSimulator\CombatantInterface');
        $stub = $this->getMockForAbstractClass('BattleSimulator\Skill\RandomSkill', [$mock]);

        $stub->expects($this->any())
             ->method('getChance')
             ->will($this->returnValue(50));

        $this->assertFalse($stub->draw(0));
    }
}
