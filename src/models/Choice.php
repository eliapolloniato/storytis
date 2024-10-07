<?php

require_once __DIR__ . "/./Model.php";
require_once __DIR__ . "/./Chapter.php";
require_once __DIR__ . "/./Reward.php";

require_once __DIR__ . "/../modifiers/modifiers.php";

class Choice extends Model
{
    protected string $optionText; // VARCHAR(255)
    protected ?int $rewardId; // INT FK (Reward.id) NULL
    protected int $chapterId; // INT FK (Chapter.id)
    protected int $nextChapterId; // INT FK (Chapter.id)
    protected int $requiredSkillType;
    protected int $requiredSkillLevel;


    public function __construct(string $optionText, Chapter $nextChapter, SkillType $requiredSkillType, int $requiredSkillLevel, Reward $reward = null, Chapter $chapter = null)
    {
        parent::__construct();
        $this->optionText = $optionText;
        if ($chapter) {
            $this->chapterId = $chapter->getId();
        }
        $this->nextChapterId = $nextChapter->getId();
        if ($reward) {
            $this->rewardId = $reward->getId();
        }

        $this->requiredSkillType = $requiredSkillType->value;
        $this->requiredSkillLevel = $requiredSkillLevel;
    }

    public function setChapterId(int $chapterId)
    {
        $this->chapterId = $chapterId;
    }

    public function setNextChapterId(int $nextChapterId)
    {
        $this->nextChapterId = $nextChapterId;
    }

    public function getOptionText(): string
    {
        return $this->optionText;
    }

    public function setOptionText(string $optionText)
    {
        $this->optionText = $optionText;
    }

    public function getChapter(): ?Chapter
    {
        return Chapter::get($this->chapterId);
    }

    public function getNextChapter(): ?Chapter
    {
        return Chapter::get($this->nextChapterId);
    }

    public function setReward(Reward $reward)
    {
        $this->rewardId = $reward->getId();
    }

    public function getReward(): ?Reward
    {
        if (!$this->rewardId) {
            return null;
        }

        return Reward::get($this->rewardId);
    }

    public function setRequiredSkillType(SkillType $skillType)
    {
        $this->requiredSkillType = $skillType->value;
    }

    public function getRequiredSkillType(): SkillType
    {
        return SkillType::cases()[$this->requiredSkillType];
    }

    public function setRequiredSkillLevel(int $requiredSkillLevel)
    {
        $this->requiredSkillLevel = $requiredSkillLevel;
    }

    public function getRequiredSkillLevel(): int
    {
        return $this->requiredSkillLevel;
    }

    public function canBeChosen(Character $character): bool
    {
        $skill = $character->getSkill($this->getRequiredSkillType());
        if ($skill === null) {
            return false;
        }
        
        return getActualValue($skill->getValue(), $character->getClass(), $skill->getType()) >= $this->getRequiredSkillLevel();
    }

    public static function getTableName()
    {
        return "Choices";
    }
}
