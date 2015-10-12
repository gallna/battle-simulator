<?php
namespace BattleSimulator;

use BattleSimulator\Skill\SkillInterface;
use BattleSimulator\Skill\RandomSkillInterface;

class SkillGenerator
{
    /**
     * @var array
     */
    private $skills = [];

    public function __construct(array $skills)
    {
        array_map([$this, "addSkill"], $skills);
    }

    public function addSkill(SkillInterface $skill)
    {
        $this->skills[] = $skill;
    }

    public function rand()
    {
        return rand(0, 100);
    }

    public function getSkill($rand = null)
    {
        $generated = null;
        foreach ($this->skills as $skill) {
            if ($skill instanceof RandomSkillInterface) {
                if ($skill->draw($rand ?: $this->rand())) {
                    $generated = $skill;
                    break;
                } else {
                    continue;
                }
            }
            $generated = $skill;
            break;
        }
        return $generated;
    }

    public function generate()
    {
        $skill = $this->getSkill();
        while (true) {
            $skill = (yield $skill) ?: $this->getSkill();
        }
    }
}
