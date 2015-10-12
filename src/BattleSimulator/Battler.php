<?php
namespace BattleSimulator;

class Battler extends AbstractCombatant
{
    /**
     * @var Generator
     */
    private $generator;

    /**
     * @var Skill\SkillInterface
     */
    private $skill;

    /**
     * [__construct description]
     *
     * @param integer $health
     * @param integer $strength
     * @param integer $defence
     * @param integer $speed
     * @param float $luck
     */
    public function __construct($health, $strength, $defence, $speed, $luck)
    {
        $this->setHealth($health);
        $this->getStrength($strength);
        $this->setDefence($defence);
        $this->setSpeed($speed);
        $this->setLuck($luck);
    }

    /**
     * Set Combatant's skill generator
     *
     * @param Generator $generator
     */
    public function setGenerator(\Generator $generator)
    {
        $this->generator = $generator;
        $this->skill = $this->generator->current();
    }

    /**
     * {@inheritdoc}
     */
    public function getGenerator()
    {
        return $this->generator;
    }

    /**
     * {@inheritdoc}
     */
    public function missed(CombatantInterface $attacker)
    {
        return $this->skill->missed($attacker);
    }

    /**
     * {@inheritdoc}
     */
    public function attack(CombatantInterface $opponent)
    {
        $damage = abs($this->getSkill()->attack($opponent));
        $opponent->reduceHealth($damage);
        return $damage;
    }

    /**
     * Generate Combatant's skill
     *
     * @return Skill\SkillInterface
     */
    private function getSkill()
    {
        $this->skill = $this->generator->current();
        $this->generator->next();
        var_dump(get_class($this->skill));
        return $this->skill;
    }
}
