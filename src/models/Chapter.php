<?php

require_once __DIR__ . "/./Model.php";

$config = require __DIR__ . "/../config.php";

class Chapter extends Model
{
    protected string $title; // VARCHAR(255)
    protected string $content; // TEXT
    protected int $storyId; // INT (AUTO_INCREMENT) FK (Story.id)
    protected array $_choices = []; // Array of Choice objects, max 4 choices

    public function __construct(Story $story, string $title, string $content, array $choices = [])
    {
        parent::__construct();
        $this->title = $title;
        $this->content = $content;
        $this->storyId = $story->getId();
        $this->_choices = $choices;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $newTitle)
    {
        $this->title = $newTitle;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $newContent)
    {
        $this->content = $newContent;
    }

    public function setStoryId(int $storyId)
    {
        $this->storyId = $storyId;
    }

    public function getChoices(): array
    {
        if (empty($this->_choices)) {
            $this->_choices = Choice::getAllBy("chapterId", $this->getId());
        }
        return $this->_choices;
    }

    /**
     * Always return an array of 4 elements
     * Fill the choices array with null values if the number of choices is less than 4
     */
    public static function getEmptyChoices(): array
    {
        global $config;
        return array_fill(0, $config['maxChoices'], null);
    }

    public function getChoicesWithEmpty(): array
    {
        global $config;

        $choices = $this->getChoices();

        if (count($choices) < $config['maxChoices']) {
            $emptyChoices = array_fill(0, $config['maxChoices'] - count($choices), null);
            return array_merge($choices, $emptyChoices);
        }

        return $choices;
    }

    public function setAsFirstChapter(): void
    {
        $story = $this->getStory();
        $story->setFirstChapter($this);
        $story->save();
    }

    public function getStory(): ?Story
    {
        return Story::get($this->storyId);
    }

    public function getOtherChapters(): array
    {
        $story = $this->getStory();
        $chapters = $story->getChapters();
        $otherChapters = [];

        foreach ($chapters as $chapter) {
            if ($chapter->getId() !== $this->getId()) {
                $otherChapters[] = $chapter;
            }
        }

        return $otherChapters;
    }

    public function addChoice(Choice $choice)
    {
        $this->_choices[] = $choice;
    }

    public function save(): int
    {
        $id = parent::save();

        // Save the choices
        foreach ($this->_choices as $choice) {
            $choice->setChapterId($this->getId());
            $choice->save();
        }

        // Save the story
        $this->getStory()->save();

        return $id;
    }
}
