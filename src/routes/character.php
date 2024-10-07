<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../router.php";
require_once __DIR__ . "/../utils/loadPage.php";
$blade = require __DIR__ . "/../utils/blade.php";

require_once __DIR__ . "/../models/Chapter.php";
require_once __DIR__ . "/../models/Story.php";
require_once __DIR__ . "/../models/Choice.php";
require_once __DIR__ . "/../models/Reward.php";
require_once __DIR__ . "/../models/Character.php";
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../enums/CharacterClass.php";
require_once __DIR__ . "/../enums/SkillType.php";
require_once __DIR__ . "/../models/Game.php";

$config = require __DIR__ . "/../config.php";

$router->mount("/character", function () use ($router, $blade) {
    $router->get("/add", function () use ($blade) {
        echo loadPage($blade->render("characterCreator"), "Creazione personaggio");
    });

    $router->post("/add", function () use ($router, $blade) {
        global $config;

        // Check if the user has already reached the max number of characters
        $characters = Character::getByUser(User::get($_SESSION["user"]));
        if (count($characters) >= $config["maxCharacters"]) {
            echo loadPage($blade->render("error", ["message" => "Hai già raggiunto il numero massimo di personaggi"]), "Errore");
            return;
        }


        // Check if the name is set
        if (!isset($_POST["characterName"]) || empty($_POST["characterName"])) {
            echo loadPage($blade->render("error", ["message" => "Il nome del personaggio non può essere vuoto"]), "Errore");
            return;
        }

        // Check if the class is set
        if (!isset($_POST["characterClass"]) || empty($_POST["characterClass"]) || !is_numeric($_POST["characterClass"])) {
            echo loadPage($blade->render("error", ["message" => "La classe del personaggio non può essere vuota"]), "Errore");
            return;
        }

        // Check if the class is valid
        if ($_POST["characterClass"] < 0 || $_POST["characterClass"] >= count(CharacterClass::cases())) {
            echo loadPage($blade->render("error", ["message" => "La classe del personaggio non è valida"]), "Errore");
            return;
        }

        // Check if the skills are valid
        $skills = [];
        // name="skill-<id>"
        
        foreach ($_POST as $key => $value) {
            if (strpos($key, "skill") !== false) {
                $skillId = explode("-", $key)[1];
                if (!is_numeric($skillId)) {
                    echo loadPage($blade->render("error", ["message" => "La skill $skillId non è valida"]), "Errore");
                    return;
                }

                try {
                    $skill = SkillType::cases()[$skillId];
                } catch (Exception $e) {
                    echo loadPage($blade->render("error", ["message" => "La skill $skillId non è valida"]), "Errore");
                    return;
                }

                $skills[] = new Skill(null, $skill, $_POST[$key]);
            }
        }

        if (count($skills) !== count(SkillType::getOnlySkills())) {
            echo loadPage($blade->render("error", ["message" => "Non hai selezionato tutte le skill"]), "Errore");
            return;
        }

        // Create the character
        $character = new Character(User::get($_SESSION["user"]), $_POST["characterName"], CharacterClass::cases()[$_POST["characterClass"]], $skills);
        $character->save();

        header("Location: /characters");
    });

    $router->get("(\d+)/delete", function ($id) use ($router, $blade) {
        $character = Character::get($id);

        if ($character === null) {
            echo loadPage($blade->render("error", ["message" => "Il personaggio non esiste"]), "Errore");
            return;
        }

        if ($character->getUser()->getId() !== $_SESSION["user"]) {
            echo loadPage($blade->render("error", ["message" => "Non puoi eliminare un personaggio che non ti appartiene"]), "Errore");
            return;
        }

        $character->delete();

        header("Location: /characters");
    });

});

// Check if the user is logged in before accessing the character subroutes
$router->before("GET|POST", "/character.*", function () {
    if (!isset($_SESSION["user"])) {
        header("Location: /login");
        return;
    }
});
