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
        echo json_encode(["success" => "Storia modificata con successo"]);
    });

    $router->get("/edit/(\d+)/addChapter", function ($id) use ($router, $blade) {
        $story = Story::get($id);
        echo loadPage($blade->render("admin.editChapter"), "Aggiungi capitolo");
    });

    $router->post("/edit/(\d+)/addChapter", function ($id) use ($router, $blade) {
        $story = Story::get($id);


        if (!isset($_POST["content"])) {
            // 400 Bad Request
            header("HTTP/1.1 400 Bad Request");
            echo "Missing content";
            return;
        }

        $chapter = new Chapter($story, $_POST["title"], $_POST["content"]);
        $chapter->save();

        header("Location: /admin/creator/edit/" . $story->getId());
    });

    $router->before("GET|POST", "/chapter/(\d+)/.*", function ($chapterId) use ($router, $blade) {
        if (!Chapter::get($chapterId)) {
            $router->trigger404();
            return;
        }
    });

    $router->get("/chapter/(\d+)/edit", function ($chapterId) use ($router, $blade) {
        $chapter = Chapter::get($chapterId);
        echo loadPage($blade->render("admin.editChapter", ["chapter" => $chapter]), "Modifica capitolo");
    });

    $router->post("/chapter/(\d+)/edit", function ($chapterId) use ($router, $blade) {
        $chapter = Chapter::get($chapterId);

        if (!isset($_POST["content"]) || !isset($_POST["title"])) {
            // 400 Bad Request
            header("HTTP/1.1 400 Bad Request");
            echo "Missing content or title";
            return;
        }

        // Remove trailing newlines
        $content = preg_replace("/\n$/m", "", $_POST["content"]);

        $chapter->setTitle($_POST["title"]);
        $chapter->setContent($content);
        $chapter->save();

        header("Location: /admin/creator/edit/" . $chapter->getStory()->getId());
    });

    $router->get("/chapter/(\d+)/delete", function ($chapterId) use ($router, $blade) {
        $chapter = Chapter::get($chapterId);
        $story = $chapter->getStory();
        $chapter->delete();

        header("Location: /admin/creator/edit/" . $story->getId());
    });

    $router->before("GET|POST", "/choice/(\d+).*", function ($choiceId) use ($router, $blade) {
        if (!Choice::get($choiceId)) {
            $router->trigger404();
            return;
        }
    });

    $router->get("/choice/(\d+)/edit", function ($choiceId) use ($router, $blade) {
        $choice = Choice::get($choiceId);
        echo loadPage($blade->render("admin.editChoice", ["choice" => $choice]), "Modifica scelta");
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
