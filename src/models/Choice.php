<?php

require_once __DIR__ . "/./Model.php";
require_once __DIR__ . "/./Chapter.php";
require_once __DIR__ . "/./Reward.php";

class Choice extends Model
{
    protected string $optionText; // VARCHAR(255)
    protected ?int $rewardId; // INT FK (Reward.id) NULL
    protected int $chapterId; // INT FK (Chapter.id)
    protected int $nextChapterId; // INT FK (Chapter.id)


    public function __construct(string $optionText, Chapter $nextChapter, Reward $reward = null, Chapter $chapter = null)
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

    public static function getTableName()
    {
        return "Choices";
    }
}
