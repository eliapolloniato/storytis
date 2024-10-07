<?php

require_once __DIR__ . "/../enums/CharacterClass.php";
require_once __DIR__ . "/../enums/SkillType.php";

// Modifiers per class
$map = array(
    CharacterClass::WARRIOR->value => array(
        SkillType::STRENGTH->value => 1,
        SkillType::INTELLIGENCE->value => 1,
        SkillType::AGILITY->value => 1,
        SkillType::LUCK->value => 1,
    ),
    CharacterClass::MAGE->value => array(
        SkillType::STRENGTH->value => 0.8,
        SkillType::INTELLIGENCE->value => 1.5,
        SkillType::AGILITY->value => 1,
        SkillType::LUCK->value => 1,
    ),
    CharacterClass::ROGUE->value => array(
        SkillType::STRENGTH->value => 1,
        SkillType::INTELLIGENCE->value => 1,
        SkillType::AGILITY->value => 1.5,
        SkillType::LUCK->value => 1.5,
    ),
);

function getActualValue(int $value, CharacterClass $class, SkillType $type): int
{
    global $map;
    return (int) $value * $map[$class->value][$type->value];
}