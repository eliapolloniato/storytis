<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../router.php";
require_once __DIR__ . "/../utils/loadPage.php";
$blade = require __DIR__ . "/../utils/blade.php";

$router->mount("/story", function () use ($router, $blade) {
    $router->get("/play/(\d+)", function ($storyId) use ($blade) {
        echo "Story $storyId";
    });
});

// Check if the user is logged in before accessing the story subroutes
$router->before("GET|POST", "/story.*", function () {
    if (!isset($_SESSION["user"])) {
        header("Location: /login");
        exit();
    }
});
