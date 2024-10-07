<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../router.php";
require_once __DIR__ . "/../utils/loadPage.php";
$blade = require __DIR__ . "/../utils/blade.php";

require_once __DIR__ . "/../models/Chapter.php";
require_once __DIR__ . "/../models/Story.php";

$router->mount("/story", function () use ($router, $blade) {
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
