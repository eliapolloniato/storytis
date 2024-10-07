<?php

enum SkillType: int
{
    case ITEM = 0;
    case STRENGTH = 1;
    case INTELLIGENCE = 2;
    case CHARISMA = 3;
    case AGILITY = 4;
    case LUCK = 5;

    public static function getOnlySkills(): array
    {
        return array_slice(self::cases(), 1);
    }
}
