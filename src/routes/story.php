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

$router->mount("/story", function () use ($router, $blade) {
    $router->get("/", function () use ($blade) {
        echo loadPage($blade->render("admin.creator"), "Home");
    });

    $router->get("/create", function () use ($blade) {
        $s = new Story("Test4");
        $s->save();
        $c1 = new Chapter($s, "Chapter 1", "This is the first chapter");
        $c1->save();
        $c2 = new Chapter($s, "Chapter 2", "This is the second chapter");
        $c2->save();
        $c3 = new Chapter($s, "Chapter 3", "This is the third chapter");
        $c3->save();

        $r1 = new Reward(SkillType::AGILITY, 2);
        $r1->save();
        $r2 = new Reward(SkillType::STRENGTH, 1);
        $r2->save();
        $ch1 = new Choice("Choice 1", $c2, $r1);
        $ch2 = new Choice("Choice 2", $c3, $r2);

        $c1->addChoice($ch1);
        $c1->addChoice($ch2);

        $s->addChapter($c1);
        $s->addChapter($c2);
        $s->addChapter($c3);

        $s->save();
    });

    // Check if story exists
    $router->before("GET|POST", "/play/(\d+).*", function ($storyId) use ($router) {
        $story = Story::get($storyId);
        if (!$story) {
            $router->trigger404();
            return;
        }
    });

    // Check if chapter exists
    $router->before("GET|POST", "/play/(\d+)/(\d+).*", function ($storyId, $chapterId) use ($router) {
        $chapter = Chapter::get($chapterId);
        if (!$chapter) {
            $router->trigger404();
            return;
        }
    });

    $router->get("/play/(\d+)", function ($storyId) use ($blade) {
        echo "Story $storyId";
    });

    $router->get("/play/(\d+)/(\d+)", function ($storyId, $chapterId) use ($blade) {
        echo "Story $storyId, Chapter $chapterId";
    });
});

// Check if the user is logged in before accessing the story subroutes
$router->before("GET|POST", "/story.*", function () {
    if (!isset($_SESSION["user"])) {
        header("Location: /login");
        return;
    }
});
