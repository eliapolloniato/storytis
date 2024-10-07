<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../router.php";
require_once __DIR__ . "/../utils/loadPage.php";
$blade = require __DIR__ . "/../utils/blade.php";

$router->mount("/home", function () use ($router, $blade) {
    $router->get("/", function () use ($blade) {
        echo loadPage($blade->render("home", ["games" => User::get($_SESSION["user"])->getGames()]), "Home");
    });
});

// Check if the user is logged in before accessing the home subroutes
$router->before("GET|POST", "/home.*", function () {
    if (!isset($_SESSION["user"])) {
        header("Location: /login");
        exit();
    }
});
