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
        "home" => "/home",
        "playStory" => "/story/play/",
        "admin" => "/admin",
        "adminCreator" => "/admin/creator/",
        "editStory" => "/admin/creator/edit/",
        "deleteStory" => "/admin/creator/delete/",
        "chapter" => "/admin/creator/chapter/",
        "choice" => "/admin/creator/choice/",
        "reward" => "/admin/creator/reward/",
        "login" => "/login",
        "logout" => "/login/logout",
        "settings" => "/settings",
        "characters" => "/characters",
    ),
    "maxChoices" => 4,
    "minRewardValue" => -10,
    "maxRewardValue" => 10,
);
