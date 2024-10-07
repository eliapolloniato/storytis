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

$router->mount("/game", function () use ($router, $blade) {

    // Check if game exists and if the user is the owner
    $router->before("GET|POST", "/(\d+).*", function ($gameId) use ($router) {
        $game = Game::get($gameId);
        if (!$game) {
            $router->trigger404();
            return;
        }

        if ($game->getUser()->getId() != $_SESSION["user"]) {
            $router->trigger404();
            return;
        }
    });

    // Delete a game
    $router->get("/(\d+)/delete", function ($gameId) use ($router) {
        $game = Game::get($gameId);
        $game->delete();
        header("Location: /home");
    });

});

// Check if the user is logged in before accessing the story subroutes
$router->before("GET|POST", "/story.*", function () {
    if (!isset($_SESSION["user"])) {
        header("Location: /login");
        return;
    }
});
