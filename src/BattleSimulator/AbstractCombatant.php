<?php
namespace BattleSimulator;

use Zend\Validator;

abstract class AbstractCombatant implements CombatantInterface
{
    /**
     * Combatant's name
     *
     * @var string
     */
    protected $name;

    /**
     * Combatant's health level.
     * Amount of health remaining.
     *
     * @var integer
     */
    protected $health;

    /**
     * Combatant's strength level.
     * Damage done when attacking.
     *
     * @var integer
     */
    protected $strength;

    /**
     * Combatant's defence level.
     * Damage reduction during defence of an attack.
     *
     * @var integer
     */
    protected $defence;

    /**
     * Combatant's speed level.
     * Determines attack order.
     *
     * @var integer
     */
    protected $speed;

    /**
     * Combatant's luck level.
     * Affects combatant's ability to dodge an sttack.
     *
     * @var float
     */
    protected $luck;

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets combatant's name.
     *
     * @param string $name Combatant's name.
     *
     * @return string
     */
    public function setName($name)
    {
        if (!is_string($name)) {
            throw new \RuntimeException("Combatant's name must be an string.");
        }
        $validator  = new Validator\StringLength(['max' => 30]);
        if (!$validator->isValid($name)) {
            throw new \RuntimeException(
                "Combatant's name must be less than 30 characters long"
            );
        }
        $this->name = $name;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * Sets combatant's health.
     *
     * @param integer $health Combatant's health.
     *
     * @return Combatant
     */
    public function setHealth($health)
    {
        if (!is_int($health)) {
            throw new \RuntimeException("Combatant's heatlh level must be an integer. Provided:".$health);
        }
        $validator  = new Validator\Between(['min' => 0, 'max' => 100]);
        if (!$validator->isValid($health)) {
            throw new \RuntimeException(
                "Combatant's heatlh level must range from 0 to 100"
            );
        }
        $this->health = $health;
        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function reduceHealth($damage)
    {
        $this->health -= $damage;
        if ($this->health <= 0) {
            throw new Exceptions\DeadCombatantException($this);
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * Sets combatant's strength.
     *
     * @param integer $strength Combatant's strength.
     *
     * @return Combatant
     */
    public function setStrength($strength)
    {
        if (!is_int($strength)) {
            throw new \RuntimeException("Combatant's strength level must be an integer. Provided:".$strength);
        }
        $validator  = new Validator\Between(['min' => 0, 'max' => 100]);
        if (!$validator->isValid($strength)) {
            throw new \RuntimeException(
                "Combatant's strength level must range from 0 to 100"
            );
        }
        $this->strength = $strength;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefence()
    {
        return $this->defence;
    }

    /**
     * Sets combatant's defence.
     *
     * @param integer $defence Combatant's defence.
     *
     * @return Combatant
     */
    public function setDefence($defence)
    {
        if (!is_int($defence)) {
            throw new \RuntimeException("Combatant's defence level must be an integer. Provided:".$defence);
        }
        $validator  = new Validator\Between(['min' => 0, 'max' => 100]);
        if (!$validator->isValid($defence)) {
            throw new \RuntimeException(
                "Combatant's defence level must range from 0 to 100"
            );
        }
        $this->defence = $defence;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Sets combatant's speed.
     *
     * @param integer $speed Combatant's speed.
     *
     * @return Combatant
     */
    public function setSpeed($speed)
    {
        if (!is_int($speed)) {
            throw new \RuntimeException("Combatant's speed level must be an integer. Provided:".$speed);
        }
        $validator  = new Validator\Between(['min' => 0, 'max' => 100]);
        if (!$validator->isValid($speed)) {
            throw new \RuntimeException(
                "Combatant's speed level must range from 0 to 100"
            );
        }
        $this->speed = $speed;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLuck()
    {
        return $this->luck;
    }

    /**
     * Sets combatant's luck.
     *
     * @param float $luck Combatant's luck.
     *
     * @return Combatant
     */
    public function setLuck($luck)
    {
        if (!is_numeric($luck)) {
            throw new \RuntimeException("Combatant's luck level must be an numeric. Provided:".$luck);
        }
        $validator  = new Validator\Between(['min' => 0, 'max' => 1]);
        if (!$validator->isValid($luck)) {
            throw new \RuntimeException(
                "Combatant's luck level must range from 0 to 100"
            );
        }
        $this->luck = $luck;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    abstract public function getGenerator();

    /**
     * {@inheritdoc}
     */
    abstract public function missed(CombatantInterface $attacker);

    /**
     * {@inheritdoc}
     */
    abstract public function attack(CombatantInterface $opponent);
}
