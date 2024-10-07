<?php

require_once __DIR__ . "/./Model.php";

class Chapter extends Model
{
    protected string $title; // VARCHAR(255)
    protected string $content; // TEXT
    protected int $storyId; // INT (AUTO_INCREMENT) FK (Story.id)
    protected int $sequenceNumber; // INT
    protected array $_choices = []; // Array of Choice objects

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

    public function getContent(): string
    {
        return $this->content;
    }

    public function setStoryId(int $storyId)
    {
        $this->storyId = $storyId;
    }

    public function setSequenceNumber(int $sequenceNumber)
    {
        $this->sequenceNumber = $sequenceNumber;
    }

    public function getSequenceNumber(): int
    {
        return $this->sequenceNumber;
    }

    public function getChoices(): array
    {
        return $this->_choices;
    }

    public function getStory(): ?Story
    {
        return Story::get($this->storyId);
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

        return $id;
    }
}
