<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../router.php";
require_once __DIR__ . "/../utils/loadPage.php";
$blade = require __DIR__ . "/../utils/blade.php";

require_once __DIR__ . "/../models/Story.php";

$config = require __DIR__ . "/../config.php";

$router->mount("/admin/creator", function () use ($router, $blade) {
    $router->get("/", function () use ($blade) {
        echo loadPage($blade->render("admin.creator", ["stories" => Story::getAll(), "admin" => true]), "Home");
    });

    $router->before("GET|POST", "/edit/(\d+)", function ($id) use ($router, $blade) {
        if (!Story::get($id)) {
            $router->trigger404();
            return;
        }
    });

    $router->get("/edit/(\d+)", function ($id) use ($router, $blade) {
        $story = Story::get($id);
        echo loadPage($blade->render("admin.edit", ["story" => $story]), "Modifica storia");
    });

    $router->post("/edit/(\d+)", function ($id) use ($router, $blade) {
        $story = Story::get($id);

        $jsonData = json_decode(file_get_contents("php://input"), true);

        if (!isset($jsonData["title"])) {
            // 400 Bad Request
            header("HTTP/1.1 400 Bad Request");
            echo json_encode(["error" => "Missing title"]);
            return;
        }

        $story->setTitle($jsonData["title"]);
        $story->save();

        // 200 OK
        header("HTTP/1.1 200 OK");
        echo json_encode(["success" => "Storia modificata con successo" . $story->getTitle()]);
    });
});

// Check if the user is admin
$router->before("GET|POST", "/admin.*", function () use ($config) {
    if (!isset($_SESSION["user"])) {
        header("Location: /login");
        exit();
    }

    if ($_SESSION["user"] !== $config["adminUser"]) {
        header("Location: /");
        exit();
    }
});
