<?php

require_once __DIR__ . "/./Model.php";
require_once __DIR__ . "/./Chapter.php";

class Story extends Model
{
    protected string $title; // VARCHAR(255)
    protected array $_chapters = [];

    /**
     * @param string $title The title of the story
     * @param Chapter[] $chapters An array of Chapter objects
     */
    public function __construct(string $title, array $chapters = [])
    {
        parent::__construct();
        $this->title = $title;
        $this->_chapters = $chapters;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getChapters(): array
    {
        return $this->_chapters;
    }

    public function addChapter(Chapter $chapter)
    {
        $this->_chapters[] = $chapter;
    }

    public function save(): int
    {
        $id = parent::save();

        // Save the chapters
        foreach ($this->_chapters as $key => $chapter) {
            $chapter->setStoryId($this->getId());
            $chapter->setSequenceNumber($key);
            $chapter->save();
        }

        return $id;
    }

    public static function getTableName()
    {
        return "Stories";
    }
}
