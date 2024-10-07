<?php

require_once __DIR__ . "/./Model.php";
require_once __DIR__ . "/./Skill.php";
require_once __DIR__ . "/../enums/SkillType.php";


class Reward extends Model
{
    protected int $affectedSkillType;
    protected string $value;
    protected string $description;

    public function __construct(string $description, SkillType $affectedSkillType, string $value = "0")
    {
        parent::__construct();
        $this->description = $description;
        $this->affectedSkillType = $affectedSkillType->value;
        $this->value = $value;
    }

    public function getAffectedSkillType(): ?SkillType
    {
        return SkillType::cases()[$this->affectedSkillType];
    }

    public function setAffectedSkillType(SkillType $affectedSkillType)
    {
        $this->affectedSkillType = $affectedSkillType->value;
    }

    public function getAffectedSkillName(): ?string
    {
        return SkillType::cases()[$this->affectedSkillType]->name;
    }

    public final function getValue(): int|string
    {
        return $this->value;
    }

    public final function setValue(int $value)
    {
        $this->value = $value;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }
}
