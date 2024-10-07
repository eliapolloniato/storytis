<?php

require_once __DIR__ . "/./Model.php";
require_once __DIR__ . "/../enums/SkillType.php";

class Skill extends Model
{
    protected int $characterId;
    protected int $typeId;
    protected int $value;

    public function __construct(?Character $character, SkillType $typeId, int $value)
    {
        parent::__construct();
        if ($character !== null) {
            $this->characterId = $character->getId();
        } else {
            $this->characterId = -1;
        }
        $this->typeId = $typeId->value;
        $this->value = $value;
    }

    public function getCharacter(): ?Character
    {
        return Character::get($this->characterId);
    }

    public function setCharacterId(int $characterId)
    {
        $this->characterId = $characterId;
    }

    public function getType(): SkillType
    {
        return SkillType::cases()[$this->typeId];
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
