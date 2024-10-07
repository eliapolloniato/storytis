<?php

require_once __DIR__ . "/./Model.php";
require_once __DIR__ . "/./Skill.php";


class Reward extends Model
{
    protected int $affectedSkillId;
    protected int $value;

    public function __construct(Skill $affectedSkill, int $value)
    {
        parent::__construct();
        $this->affectedSkillId = $affectedSkill->getId();
        $this->value = $value;
    }

    public function getAffectedSkill(): ?Skill
    {
        return Skill::get($this->affectedSkillId);
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
