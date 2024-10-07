<?php

require_once __DIR__ . "/./Model.php";
require_once __DIR__ . "/./Item.php";
require_once __DIR__ . "/./Character.php";


class InventoryItem extends Model
{
    protected int $itemId;
    protected int $characterId;

    public function __construct(Character $character, Item $item)
    {
        parent::__construct();
        $this->itemId = $item->getId();
        $this->characterId = $character->getId();
    }

    public function getItem(): Item
    {
        return Item::get($this->itemId);
    }

    public function getCharacter(): Character
    {
        return Character::get($this->characterId);
    }
}
