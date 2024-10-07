<?php

$config = require __DIR__ . "/../config.php";
$blade = require __DIR__ . "/blade.php";

function loadPage($content, $title = "")
{
    global $config, $blade;

    $basePage = file_get_contents($config["basePage"]);

    $basePage = str_replace("%%navbar%%", $blade->render("navbar"), $basePage);
    $basePage = str_replace("%%content%%", $content, $basePage);
    $basePage = str_replace("%%pageTitle%%", $title, $basePage);

    return $basePage;
}
