<?php
// Require composer autoloader
require __DIR__ . "/../vendor/autoload.php";

$config = require __DIR__ . "/config.php";

require_once __DIR__ . "/utils/loadPage.php";

$router = new \Bramus\Router\Router();

$blade = new \Jenssegers\Blade\Blade("views", "cache");

function loadPage($content, $title = "")
{
    global $config, $blade;

    $basePage = file_get_contents($config["basePage"]);

    $basePage = str_replace("%%navbar%%", $blade->render("navbar", ["title" => $title]), $basePage);
    $basePage = str_replace("%%content%%", $content, $basePage);
    $basePage = str_replace("%%pageTitle%%", $title, $basePage);

    return $basePage;
}

$router->get("/", function () {
    global $blade;
    echo loadPage($blade->render("home", ["text" => "Hello World!"]), "Home");
});

$router->get("/123", function () {
    global $blade;
    echo loadPage($blade->render("home", ["text" => "Hello World!"]), "Home");
});

$router->run();