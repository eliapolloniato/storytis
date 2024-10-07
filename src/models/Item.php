<?php

require_once __DIR__ . "/./Model.php";
require_once __DIR__ . "/./Reward.php";
require_once __DIR__ . "/../enums/SkillType.php";


class Item extends Reward
{
    public function __construct(string $itemText, string $description)
    {
        parent::__construct($description, SkillType::ITEM, $itemText);
    }

    public function getItemText(): string
    {
        return $this->value;
    }

    public function setItemText(string $itemText)
    {
        $this->value = $itemText;
    }

    public static function isItem(Reward $reward): bool
    {
        return $reward->getAffectedSkillType() === SkillType::ITEM;
    }

    // Share the same table as Reward
    public static function getTableName()
    {
        return "Rewards";
    }
}
