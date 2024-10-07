<?php

return array(
    "views" => __DIR__ . "/views",
    "cache" => __DIR__ . "/cache",
    "dist" => __DIR__ . "/dist",
    "routes" => __DIR__ . "/routes",
    "basePage" => __DIR__ . "/base.html",
    "baseUrl" => "http://contabile.e-fermi.it:" . $_SERVER["SERVER_PORT"],
    "adminUser" => -1,
    "routes" => array(
        "playStory" => "/story/play/",
        "admin" => "/admin",
        "adminCreator" => "/admin/creator",
        "editStory" => "/admin/creator/edit/",
        "chapter" => "/admin/creator/chapter/",
        "choice" => "/admin/creator/choice/",
    ),
    "maxChoices" => 4,
);
