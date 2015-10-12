<?php
namespace BattleSimulator\Skill;

interface RandomSkillInterface extends SkillInterface
{
    /**
     * Returns draw result
     *
     * @return boolean
     */
    public function draw($rand);
}
