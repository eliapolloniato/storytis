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

$router->mount("/settings", function () use ($router, $blade) {
    $router->get("/", function () use ($blade) {
        echo loadPage($blade->render("settings"), "Impostazioni");
    });

    $router->post("/", function () use ($blade) {

        if (!isset($_POST["username"]) || empty($_POST["username"])) {
            echo loadPage($blade->render("error", ["message" => "Il nome utente non può essere vuoto"]), "Errore");
            return;
        }

        if (!isset($_POST["password"]) || empty($_POST["password"])) {
            echo loadPage($blade->render("error", ["message" => "La password non può essere vuota"]), "Errore");
            return;
        }

        $user = User::get($_SESSION["user"]);

        // Check if username is already taken
        if (User::findByName($_POST["username"]) !== null) {
            echo loadPage($blade->render("error", ["message" => "Il nome utente è già in uso"]), "Errore");
            return;
        }

        $user->setName($_POST["username"]);
        $user->setPassword($_POST["password"]);
        
        $user->save();

        header("Location: /settings");
    });
});

// Check if the user is logged in before accessing the settings subroutes
$router->before("GET|POST", "/character.*", function () {
    if (!isset($_SESSION["user"])) {
        header("Location: /login");
        return;
    }
});
