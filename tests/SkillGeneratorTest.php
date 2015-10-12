<?php
use BattleSimulator\SkillGenerator;

class SkillGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testRandomSkill()
    {
        $randomedSkillsMock = $this->getMock('BattleSimulator\Skill\RandomSkillInterface');
        $randomedSkillsMock->expects($this->once())
            ->method('draw')
            ->will($this->returnValue(true));
        $skillMock = $this->getMock('BattleSimulator\Skill\SkillInterface');

        $generator = new SkillGenerator([$randomedSkillsMock, $skillMock]);
        $skill = $generator->getSkill();
        $this->assertEquals($skill, $randomedSkillsMock);
    }

    public function testOnlyRandomSkills()
    {
        $randomedSkillsMock = $this->getMock('BattleSimulator\Skill\RandomSkillInterface');
        $randomedSkillsMock->expects($this->once())
            ->method('draw')
            ->will($this->returnValue(true));
        $randomedSkillsMock2 = $this->getMock('BattleSimulator\Skill\RandomSkillInterface');
        $randomedSkillsMock2->expects($this->never())
            ->method('draw')
            ->will($this->returnValue(true));


        $generator = new SkillGenerator([$randomedSkillsMock, $randomedSkillsMock2]);
        $skill = $generator->getSkill();
        $this->assertEquals($skill, $randomedSkillsMock);
    }

    public function testSecondRandomSkill()
    {
        $randomedSkillsMock = $this->getMock('BattleSimulator\Skill\RandomSkillInterface');
        $randomedSkillsMock->expects($this->once())
            ->method('draw')
            ->will($this->returnValue(false));
        $randomedSkillsMock2 = $this->getMock('BattleSimulator\Skill\RandomSkillInterface');
        $randomedSkillsMock2->expects($this->once())
            ->method('draw')
            ->will($this->returnValue(true));


        $generator = new SkillGenerator([$randomedSkillsMock, $randomedSkillsMock2]);
        $skill = $generator->getSkill();
        $this->assertEquals($skill, $randomedSkillsMock2);
    }

    public function testRandomAndNotRandomSkill()
    {
        $skillMock = $this->getMock('BattleSimulator\Skill\SkillInterface');
        $randomedSkillsMock = $this->getMock('BattleSimulator\Skill\RandomSkillInterface');
        $randomedSkillsMock->expects($this->once())
            ->method('draw')
            ->will($this->returnValue(false));

        $generator = new SkillGenerator([$randomedSkillsMock, $skillMock]);
        $skill = $generator->getSkill();
        $this->assertEquals($skill, $skillMock);
    }

    public function testNotRandomAndRandomSkill()
    {
        $skillMock = $this->getMock('BattleSimulator\Skill\SkillInterface');
        $randomedSkillsMock = $this->getMock('BattleSimulator\Skill\RandomSkillInterface');
        $randomedSkillsMock->expects($this->never())
            ->method('draw')
            ->will($this->returnValue(false));

        $generator = new SkillGenerator([$skillMock, $randomedSkillsMock]);
        $skill = $generator->getSkill();
        $this->assertEquals($skill, $skillMock);
    }

    public function testGenerator()
    {
        $skillMock = $this->getMock('BattleSimulator\Skill\SkillInterface');
        $skillMock2 = $this->getMock('BattleSimulator\Skill\SkillInterface');

        $skillGenerator = new SkillGenerator([$skillMock, $skillMock2]);
        $generator = $skillGenerator->generate($skillMock);
        $this->assertInstanceOf("Generator", $generator);
    }

    public function testGeneratorCurrent()
    {
        $skillMock = $this->getMock('BattleSimulator\Skill\SkillInterface');
        $skillMock2 = $this->getMock('BattleSimulator\Skill\SkillInterface');

        $skillGenerator = new SkillGenerator([$skillMock, $skillMock2]);
        $generator = $skillGenerator->generate();
        $this->assertEquals($skillMock, $generator->current());
        $generator->next();
        $this->assertEquals($skillMock, $generator->current());
    }

    public function testGeneratorSend()
    {
        $skillMock = $this->getMock('BattleSimulator\Skill\RandomSkillInterface');
        $skillMock->expects($this->any())
            ->method('draw')
            ->will($this->returnValue(false));
        $skillMock2 = $this->getMock('BattleSimulator\Skill\SkillInterface');
        $skillMock3 = $this->getMock('BattleSimulator\Skill\SkillInterface');

        $skillGenerator = new SkillGenerator([$skillMock, $skillMock2]);
        $generator = $skillGenerator->generate();
        $this->assertTrue($skillMock2 === $generator->current());
        $generator->next();
        $this->assertTrue($skillMock2 === $generator->current());
        $generator->send($skillMock3);
        $this->assertTrue($skillMock3 === $generator->current());
        $generator->next();
        $this->assertTrue($skillMock2 === $generator->current());
    }
}
