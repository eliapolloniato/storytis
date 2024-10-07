<?php
// Require composer autoloader
require __DIR__ . "/../vendor/autoload.php";

$router = new \Bramus\Router\Router();

$blade = new \Jenssegers\Blade\Blade("views", "cache");

$router->get("/static/style/(\w+)", function ($file) {
    $filePath = __DIR__ . "/static/style/" . $file;

    $filePath = filter_var($filePath, FILTER_SANITIZE_STRING);

    if (file_exists($filePath)) {
        header('Content-type: text/css');
        echo file_get_contents($filePath);
    }
});

$router->get("/", function () {
    global $blade;
    echo $blade->render("home", ["text" => "Hello World!"]);
});

$router->run();