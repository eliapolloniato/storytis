<?php

require_once __DIR__ . "/./Model.php";
require_once __DIR__ . "/./Skill.php";
require_once __DIR__ . "/./User.php";
require_once __DIR__ . "/../enums/CharacterClass.php";

class Character extends Model
{
    protected int $userId;
    protected string $name;
    protected int $classId;
    protected array $_skills = [];

    public function __construct(User $user, string $name, CharacterClass $classId,  array $skills = [])
    {
        parent::__construct();
        $this->userId = $user->getId();
        $this->name = $name;
        $this->_skills = $skills;
        $this->classId = $classId->value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSkills(): array
    {
        if (empty($this->_skills)) {
            $this->_skills = Skill::getAllBy("characterId", $this->getId());
        }
        return $this->_skills;
    }

    public function getSkill(SkillType $type): ?Skill
    {
        foreach ($this->getSkills() as $skill) {
            if ($skill->getType() == $type) {
                return $skill;
            }
        }
        return null;
    }

    public function getClass(): CharacterClass
    {
        return CharacterClass::cases()[$this->classId];
    }

    public function getUser(): User
    {
        return User::get($this->userId);
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

    public static function getByUser(User $user): array
    {
        return self::getAllBy("userId", $user->getId());
    }

    public function getInventory(): array
    {
        return InventoryItem::getAllBy("characterId", $this->getId());
    }
}
