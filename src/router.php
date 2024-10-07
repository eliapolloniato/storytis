<?php
// Require composer autoloader
require __DIR__ . "/../vendor/autoload.php";

require_once __DIR__ . "/utils/loadPage.php";
$blade = require __DIR__ . "/utils/blade.php";

$config = require __DIR__ . "/config.php";

$router = new \Bramus\Router\Router();


/* MOUNT ROUTES */
<<<<<<< HEAD

$router->mount('/movies', function () use ($router) {

    // will result in '/movies/'
    $router->get('/', function () {
        echo 'movies overview';
    });

    // will result in '/movies/id'
    $router->get('/(\d+)', function ($id) {
        echo 'movie id ' . htmlentities($id);
    });
});

=======
>>>>>>> refs/rewritten/develop
foreach (glob(__DIR__ . "/routes/*.php") as $filename) {
    require $filename;
}

/* 404 */
$router->set404(function () use ($blade) {
    header('HTTP/1.1 404 Not Found');
    echo loadPage($blade->render("404"), "404");
});

/* LANDING PAGE */
$router->get("/", function () use ($blade) {
    echo loadPage($blade->render("landing"), "Storytis");
});

return $router;
