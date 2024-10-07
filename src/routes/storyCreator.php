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
        echo loadPage($blade->render("admin.creator", ["stories" => Story::getAll(), "admin" => true]), "Creatore");
    });

    $router->get("/add", function () use ($router, $blade) {
        echo loadPage($blade->render("admin.edit"), "Aggiungi storia");
    });

    $router->post("/add", function () use ($router, $blade) {
        if (!isset($_POST["title"])) {
            // 400 Bad Request
            header("HTTP/1.1 400 Bad Request");
            echo "Missing title";
            return;
        }

        $story = new Story($_POST["title"]);
        $story->save();

        header("Location: /admin/creator/edit/" . $story->getId());
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

        if (!isset($_POST["title"])) {
            // 400 Bad Request
            header("HTTP/1.1 400 Bad Request");
            echo "Missing title";
            return;
        }

        $story->setTitle($_POST["title"]);
        $story->save();

        header("Location: /admin/creator/edit/" . $story->getId());
    });

    $router->get("/edit/(\d+)/addChapter", function ($id) use ($router, $blade) {
        $story = Story::get($id);
        echo loadPage($blade->render("admin.editChapter", ["story" => $story]), "Aggiungi capitolo");
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

        header("Location: /admin/creator/chapter/" . $chapter->getId() . "/edit");
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

        header("Location: /admin/creator/chapter/" . $chapter->getId() . "/edit");
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

    $router->post("/choice/(\d+)/edit", function ($choiceId) use ($router, $blade) {
        $choice = Choice::get($choiceId);

        if (!isset($_POST["optionText"]) || !isset($_POST["nextChapter"])) {
            // 400 Bad Request
            header("HTTP/1.1 400 Bad Request");
            echo "Missing optionText or nextChapter";
            return;
        }

        $choice->setOptionText($_POST["optionText"]);
        $choice->setNextChapterId($_POST["nextChapter"]);
        $choice->save();

        header("Location: /admin/creator/chapter/" . $choice->getChapter()->getId() . "/edit");
    });

    $router->get("/chapter/(\d+)/addChoice", function ($chapterId) use ($router, $blade) {
        $chapter = Chapter::get($chapterId);
        echo loadPage($blade->render("admin.editChoice", ["chapter" => $chapter]), "Aggiungi scelta");
    });

    $router->post("/chapter/(\d+)/addChoice", function ($chapterId) use ($router, $blade) {
        if (!isset($_POST["optionText"]) || !isset($_POST["nextChapter"])) {
            // 400 Bad Request
            header("HTTP/1.1 400 Bad Request");
            echo "Missing optionText or nextChapter";
            return;
        }

        $newChoice = new Choice($_POST["optionText"], Chapter::get($_POST["nextChapter"]), null, Chapter::get($chapterId));
        $newChoice->save();

        header("Location: /admin/creator/chapter/" . $chapterId . "/edit");
    });

    $router->before("GET|POST", "/reward/(\d+).*", function ($rewardId) use ($router, $blade) {
        if (!Reward::get($rewardId)) {
            $router->trigger404();
            return;
        }
    });

    $router->get("/reward/(\d+)/delete", function ($rewardId) use ($router, $blade) {
        $reward = Reward::get($rewardId);
        $reward->delete();

        header("Location: /admin/creator");
    });

    $router->get("/reward/(\d+)/edit", function ($rewardId) use ($router, $blade) {
        $reward = Reward::get($rewardId);
        echo loadPage($blade->render("admin.editReward", ["reward" => $reward]), "Modifica ricompensa");
    });

    $router->post("/reward/(\d+)/edit", function ($rewardId) use ($router, $blade) {
        $reward = Reward::get($rewardId);

        if (!isset($_POST["value"]) || !isset($_POST["description"]) || !isset($_POST["affectedSkillType"])) {
            // 400 Bad Request
            header("HTTP/1.1 400 Bad Request");
            echo "Missing value, description or affectedSkillType";
            return;
        }

        if (!is_numeric($_POST["value"])) {
            // 400 Bad Request
            header("HTTP/1.1 400 Bad Request");
            echo "Value must be a number";
            return;
        }

        if ($_POST["affectedSkillType"] < 0 || $_POST["affectedSkillType"] >= count(SkillType::cases())) {
            // 400 Bad Request
            header("HTTP/1.1 400 Bad Request");
            echo "Invalid affectedSkillType";
            return;
        }

        $reward->setDescription($_POST["description"]);
        $reward->setValue($_POST["value"]);
        $reward->setAffectedSkillType(SkillType::cases()[$_POST["affectedSkillType"]]);
        $reward->save();

        header("Location: " . $_SERVER["REQUEST_URI"]);
    });

    $router->get("/reward/add", function () use ($router, $blade) {
        echo loadPage($blade->render("admin.editReward"), "Aggiungi ricompensa");
    });

    $router->post("/reward/add", function () use ($router, $blade) {
        if (!isset($_POST["value"]) || !isset($_POST["description"]) || !isset($_POST["affectedSkillType"])) {
            // 400 Bad Request
            header("HTTP/1.1 400 Bad Request");
            echo "Missing value, description or affectedSkillType";
            return;
        }

        if (!is_numeric($_POST["value"])) {
            // 400 Bad Request
            header("HTTP/1.1 400 Bad Request");
            echo "Value must be a number";
            return;
        }

        if ($_POST["affectedSkillType"] < 0 || $_POST["affectedSkillType"] >= count(SkillType::cases())) {
            // 400 Bad Request
            header("HTTP/1.1 400 Bad Request");
            echo "Invalid affectedSkillType";
            return;
        }

        $newReward = new Reward($_POST["description"], SkillType::cases()[$_POST["affectedSkillType"]], $_POST["value"]);
        $newReward->save();

        header("Location: /admin/creator/reward/" . $newReward->getId() . "/edit");
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
