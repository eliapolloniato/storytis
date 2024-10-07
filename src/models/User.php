<?php

require_once __DIR__ . "/./Model.php";
require_once __DIR__ . "/./Game.php";
require_once __DIR__ . "/./Character.php";

$config = require __DIR__ . "/../config.php";

class User extends Model
{
    protected string $name;
    protected string $password;

    public function __construct(string $name, string $password)
    {
        parent::__construct();
        $this->name = $name;
        // hash password with bcrypt
        $this->password = self::hashPassword($password);
        // $this->save();
    }

    private static function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }

    public static function findByName($name): ?User
    {
        return self::getByAttribute("name", $name);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setPassword(string $password)
    {
        $this->password = self::hashPassword($password);
    }



    public function getHashedPassword(): string
    {
        return $this->password;
    }

    public function getGames(): array
    {
        return Game::getByUser($this);
    }

    public function getCharacters(): array
    {
        return Character::getByUser($this);
    }

    public function getCharacter(int $id): ?Character
    {
        $characters = $this->getCharacters();
        foreach ($characters as $character) {
            if ($character->getId() === $id) {
                return $character;
            }
        }
        return null;
    }

    public function isAdmin(): bool
    {
        global $config;
        return $this->getId() === $config["adminUser"];
    }
}
