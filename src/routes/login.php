<?php
require_once __DIR__ . "/../router.php";
require_once __DIR__ . "/../utils/loadPage.php";
$blade = require __DIR__ . "/../utils/blade.php";

$router->mount("/login", function () use ($router, $blade) {
    $router->get("/", function () use ($blade) {
        echo loadPage($blade->render("login", ["action" => "login"]), "Login");
    });

    $router->get("/register", function () use ($blade) {
        echo loadPage($blade->render("login", ["action" => "register"]), "Registrati");
    });
});