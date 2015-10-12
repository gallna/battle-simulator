<?php
namespace BattleSimulator\Exceptions;

use BattleSimulator\CombatantInterface;

class DeadCombatantException extends \Exception
{
    /**
     * @var Combatant
     */
    private $combatant;

    public function __construct(CombatantInterface $combatant)
    {
        $this->combatant = $combatant;
        parent::__construct("Combatant died");
    }

    /**
     * Returns died combatant's object.
     *
     * @return CombatantInterface
     */
    public function getCombatant()
    {
        return $this->combatant;
    }
}
