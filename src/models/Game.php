<?php

require_once __DIR__ . "/./Model.php";
require_once __DIR__ . "/./User.php";
require_once __DIR__ . "/./Story.php";
require_once __DIR__ . "/./Character.php";

class Game extends Model
{
    protected int $userId;
    protected int $storyId;
    protected int $characterId;
    protected string $startDate; // DATE
    protected int $chapterId;

    public function __construct(Story $story, User $user, Character $character, ?Chapter $chapter)
    {
        parent::__construct();
        $this->userId = $user->getId();
        $this->storyId = $story->getId();
        $this->characterId = $character->getId();
        $this->chapterId = $chapter->getId();
        $this->startDate = date("Y-m-d");
    }

    public function getStory(): Story
    {
        return Story::get($this->storyId);
    }

    public function getUser(): User
    {
        return User::get($this->userId);
    }

    public function getCharacter(): Character
    {
        return Character::get($this->characterId);
    }

    public function getChapter(): Chapter
    {
        return Chapter::get($this->chapterId);
    }

    public function setChapter(Chapter $chapter): void
    {
        $this->chapterId = $chapter->getId();
    }

    public function getStartDate(): string
    {
        return $this->startDate;
    }

    public function setStartDate(string $startDate): void
    {
        $this->startDate = $startDate;
    }

    public static function getByUser(User $user): array
    {
        return parent::getAllBy("userId", $user->getId());
    }

}
