<?php
namespace BattleSimulator\Skill;

use BattleSimulator\CombatantInterface;

/**
 * With each attack there is a 2% chance of stunning the enemy, causing them
 * to miss their next attack.
 */
class StunningBlow extends RandomSkill
{
    const STUNNING_BLOW_CHANCE = 50;

    private $stunned = false;

    /**
     * {@inheritdoc}
     */
    public function getChance()
    {
        return self::STUNNING_BLOW_CHANCE;
    }

    /**
     * {@inheritdoc}
     */
    public function attack(CombatantInterface $opponent)
    {
        $damage = parent::attack($opponent);
        $stunned = new StunnedCombatant($opponent);
        if (!$this->stunned) {
            $opponent->getGenerator()->send($stunned);
            $this->stunned = true;
        }

        return $damage;
    }
}
