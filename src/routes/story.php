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
require_once __DIR__ . "/../models/InventoryItem.php";

$router->mount("/story", function () use ($router, $blade) {
    $router->get("/play/new", function() use ($router, $blade) {
        // Check if story exists
        if (!isset($_GET["storyId"]) || !is_numeric($_GET["storyId"]) || Story::get($_GET["storyId"]) === null) {
            $router->trigger404();
            return;
        }

        // Check if character is selected
        if (!isset($_GET["charId"]) || !is_numeric($_GET["charId"]) || Character::get($_GET["charId"]) === null) {
            echo loadPage($blade->render("selectCharacter", ["storyId" => $_GET["storyId"]]), "Seleziona il personaggio");
            return;
        }


        $newGame = new Game(Story::get($_GET["storyId"]), User::get($_SESSION["user"]), Character::get($_GET["charId"]), null);

        $newGame->save();

        header("Location: /story/play/" . $newGame->getId());
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

        if (!$choice) {
            $router->trigger404();
            return;
        }

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

        // Check if there is a message to show
        $message = null;
        if (isset($_SESSION["message"])) {
            $message = $_SESSION["message"];
            unset($_SESSION["message"]);
        }

        echo loadPage($blade->render("story", [
            "story" => $story,
            "game" => $game,
            "chapter" => $game->getChapter(),
            "choices" => $game->getChapter()->getChoices(),
            "message" => $message,
        ]), $story->getTitle());
    });

    // Choice clicked
    $router->get("/play/(\d+)/(\d+)", function ($gameId, $choiceId) use ($blade) {
        $game = Game::get($gameId);
        $choice = Choice::get($choiceId);

        // Check if the choice can be made
        $character = $game->getCharacter();
        if (!$choice->canBeChosen($character)) {
            $_SESSION["message"] = "Non hai abbastanza punti " . $choice->getRequiredSkillType()->name . " per fare questa scelta!";
            header("Location: /story/play/$gameId");
            return;
        }

        // Update game chapter
        $game->setChapter($choice->getNextChapter());
        $game->save();

        /* ----- REWARD ----- */
        $reward = $choice->getReward();

        if ($reward === null) {
            header("Location: /story/play/$gameId");
            return;
        }

        // Get reward message
        $message = $reward->getDescription();
        $_SESSION["message"] = $message;

        // Give reward to character
        $character = $game->getCharacter();

        // If the reward is an item, add it to the inventory
        if (Item::isItem($reward)) {
            $ii = new InventoryItem($character, Item::get($reward->getId()));
            $ii->save();
        } else {
            // If the reward is a skill, modify the character's skill
            $skill = $character->getSkill($reward->getAffectedSkillType());
            if ($skill !== null) {
                $skill->setValue($skill->getValue() + $reward->getValue());
                $skill->save();
            }
        }

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
