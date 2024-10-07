<?php

require_once __DIR__ . "/./Model.php";
require_once __DIR__ . "/./Chapter.php";
require_once __DIR__ . "/./Reward.php";

class Story extends Model
{
    protected string $title; // VARCHAR(255)
    protected ?int $firstChapterId; // INT
    protected array $_chapters = [];

    /**
     * @param string $title The title of the story
     * @param Chapter[] $chapters An array of Chapter objects
     */
    public function __construct(string $title, array $chapters = [])
    {
        parent::__construct();
        $this->title = $title;
        $this->firstChapterId = null;
        $this->_chapters = $chapters;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $newTitle)
    {
        $this->title = $newTitle;
    }

    public function getChapters(): array
    {
        if ($this->getId() === null) {
            return $this->_chapters;
        }
        if (empty($this->_chapters)) {
            $this->_chapters = Chapter::getAllBy("storyId", $this->getId());
        }
        return $this->_chapters;
    }

    public function getFirstChapter(): ?Chapter
    {
        if (empty($this->firstChapterId)) {
            return null;
        }

        return Chapter::get($this->firstChapterId);
    }

    public function setFirstChapter(Chapter $chapter): void
    {
        $this->firstChapterId = $chapter->getId();
    }

    public function save(): int
    {
        // If there is 1 chapter, set it as first chapter

        if (count($this->getChapters()) === 1) {
            $this->setFirstChapter($this->getChapters()[0]);
        }
        
        $id = parent::save();

        return $id;
    }

    /**
     * Necessary to load Reward class
     */
    public static function getAllRewards(): array
    {
        return Reward::getAll();
    }

    public static function getTableName()
    {
        return "Stories";
    }
}
