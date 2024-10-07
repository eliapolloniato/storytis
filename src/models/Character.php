<?php

require_once __DIR__ . "/./Model.php";
require_once __DIR__ . "/./Skill.php";
require_once __DIR__ . "/../enums/CharacterClass.php";

class Character extends Model
{
    protected string $name;
    protected CharacterClass $classId;
    protected array $_skills = [];

    public function __construct(string $name, CharacterClass $classId,  array $skills = [])
    {
        parent::__construct();
        $this->name = $name;
        $this->_skills = $skills;
        $this->classId = $classId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSkills(): array
    {
        return $this->_skills;
    }

    public function getClassId(): CharacterClass
    {
        return $this->classId;
    }

    public function addSkill(Skill $skill)
    {
        $this->_skills[] = $skill;
    }

    public function save(): int
    {
        $id = parent::save();

        // Save the skills
        foreach ($this->_skills as $skill) {
            $skill->setCharacterId($this->getId());
            $skill->save();
        }

        return $id;
    }
}
