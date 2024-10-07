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

$router->mount("/story", function () use ($router, $blade) {
    $router->get("/", function () use ($blade) {
        echo loadPage($blade->render("games"), "Storie");
    });

    // Check if game exists and if the user is the owner
    $router->before("GET|POST", "/play/(\d+).*", function ($gameId) use ($router) {
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

    // Check if choice exists
    $router->before("GET|POST", "/play/(\d+)/(\d+).*", function ($gameId, $choiceId) use ($router) {
        $choice = Choice::get($choiceId);

        // Check if chapter belongs to story
        $story = Game::get($gameId)->getStory();
        if ($choice->getNextChapter()->getStory() != $story) {
            $router->trigger404();
            return;
        }
    });

    $router->get("/play/(\d+)", function ($gameId) use ($blade) {
        $game = Game::get($gameId);
        $story = $game->getStory();

        echo loadPage($blade->render("story", [
            "story" => $story,
            "game" => $game,
            "chapter" => $game->getChapter(),
            "choices" => $game->getChapter()->getChoices()
        ]), $story->getTitle());
    });

    // Choice clicked
    $router->get("/play/(\d+)/(\d+)", function ($gameId, $choiceId) use ($blade) {
        $game = Game::get($gameId);
        $choice = Choice::get($choiceId);

        // Update game chapter
        $game->setChapter($choice->getNextChapter());
        $game->save();

        header("Location: /story/play/$gameId");
    });
});

// Check if the user is logged in before accessing the story subroutes
$router->before("GET|POST", "/story.*", function () {
    if (!isset($_SESSION["user"])) {
        header("Location: /login");
        return;
    }
});
