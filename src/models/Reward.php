<?php

require_once __DIR__ . "/./Model.php";
require_once __DIR__ . "/./Skill.php";
require_once __DIR__ . "/../enums/SkillType.php";


class Reward extends Model
{
    protected int $affectedSkillType;
    protected int $value;

    public function __construct(SkillType $affectedSkillType, int $value)
    {
        parent::__construct();
        $this->affectedSkillType = $affectedSkillType->value;
        $this->value = $value;
    }

    public function getAffectedSkillType(): ?SkillType
    {
        return SkillType::cases()[$this->affectedSkillType];
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value)
    {
        $this->value = $value;
    }
}
