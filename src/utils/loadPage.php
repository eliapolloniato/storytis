<?php

$config = require __DIR__ . "/../config.php";

function loadPage($content, $title = "")
{
    global $config;

    $basePage = file_get_contents($config["basePage"]);

    $basePage = str_replace("%%content%%", $content, $basePage);
    $basePage = str_replace("%%pageTitle%%", $title, $basePage);

    return $basePage;
}