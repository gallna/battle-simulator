<?php
require 'vendor/autoload.php';

use BattleSimulator\Combatant;
use BattleSimulator\SkillGenerator;
use BattleSimulator\Battler;
use BattleSimulator\Skill\DefaultSkill;
use BattleSimulator\Skill\CounterAttack;
use BattleSimulator\Skill\StunningBlow;
use BattleSimulator\Exceptions\DeadCombatantException;

$queue = new \SplPriorityQueue();

$combatant = new Battler(100, 20, 10, 50, 1);
$generator = new SkillGenerator([
    new CounterAttack($combatant),
    new DefaultSkill($combatant),
]);
$combatant->setGenerator($generator->generate());
$queue->insert($combatant, [$combatant->getSpeed(), $combatant->getDefence(), 1]);

$combatant = new Battler(100, 20, 10, 90, 1);
$generator = new SkillGenerator([
    new StunningBlow($combatant),
    new DefaultSkill($combatant),
]);
$combatant->setGenerator($generator->generate());
$queue->insert($combatant, [$combatant->getSpeed(), $combatant->getDefence(), 1]);

$attacker = $queue->extract();
$defender = $queue->extract();

for ($i = 1; $i <= 30; ++$i) {
    try {
        $attacker->attack($defender);
    } catch (DeadCombatantException $e) {
        $looser = $e->getCombatant();
        $winner = ($looser === $attacker) ? $defender : $attacker;
        break;
    }

    $att = $attacker;
    $attacker = $defender;
    $defender = $att;
}
