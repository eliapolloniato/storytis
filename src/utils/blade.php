<?php
// Require composer autoloader
require __DIR__ . "/../../vendor/autoload.php";

$config = require __DIR__ . "/../config.php";

$blade = new \Jenssegers\Blade\Blade($config["views"], $config["cache"]);

// Global vars
$blade->share("config", $config);

return $blade;
