<?php
// Require composer autoloader
require __DIR__ . "/../vendor/autoload.php";

$config = require __DIR__ . "/config.php";

$router = require __DIR__ . "/router.php";

$router->run();