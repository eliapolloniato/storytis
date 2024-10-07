<?php

enum SkillType: int
{
    case ITEM = 0;
    case STRENGTH = 1;
    case INTELLIGENCE = 2;
    case AGILITY = 3;
    case LUCK = 4;

    public static function getOnlySkills(): array
    {
        return array_slice(self::cases(), 1);
    }
}
