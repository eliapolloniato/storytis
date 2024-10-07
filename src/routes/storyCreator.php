<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../router.php";
require_once __DIR__ . "/../utils/loadPage.php";
$blade = require __DIR__ . "/../utils/blade.php";

require_once __DIR__ . "/../models/Story.php";
require_once __DIR__ . "/../models/Reward.php";
require_once __DIR__ . "/../models/Item.php";

$config = require __DIR__ . "/../config.php";

$router->mount("/admin/creator", function () use ($router, $blade) {
    $router->get("/", function () use ($blade) {
        echo loadPage($blade->render("admin.creator", ["stories" => Story::getAll()]), "Creatore");
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

    $router->get("/delete", function () use ($router, $blade) {
        if (!isset($_GET["id"])) {
            // 400 Bad Request
            header("HTTP/1.1 400 Bad Request");
            echo "Missing id";
            return;
        }

        if (!is_numeric($_GET["id"])) {
            // 400 Bad Request
            header("HTTP/1.1 400 Bad Request");
            echo "Invalid id";
            return;
        }

        if (!Story::get($_GET["id"])) {
            // 404 Not Found
            header("HTTP/1.1 404 Not Found");
            echo "Story not found";
            return;
        }

        $story = Story::get($_GET["id"]);
        $story->delete();

        header("Location: /admin/creator");
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
            echo "Missing optionText, nextChapter or reward";
            return;
        }

        if (!is_numeric($_POST["nextChapter"])) {
            // 400 Bad Request
            header("HTTP/1.1 400 Bad Request");
            echo "Invalid nextChapter or reward";
            return;
        }

        if (!empty($_POST["reward"])) {
            if (!is_numeric($_POST["reward"])) {
                // 400 Bad Request
                header("HTTP/1.1 400 Bad Request");
                echo "Invalid reward";
                return;
            }

            if (!Reward::get($_POST["reward"])) {
                // 400 Bad Request
                header("HTTP/1.1 400 Bad Request");
                echo "Invalid reward";
                return;
            }
        }

        if (!Chapter::get($_POST["nextChapter"])) {
            // 400 Bad Request
            header("HTTP/1.1 400 Bad Request");
            echo "Invalid nextChapter";
            return;
        }

        $choice->setOptionText($_POST["optionText"]);
        $choice->setNextChapterId($_POST["nextChapter"]);

        if (!empty($_POST["reward"])) {
            $choice->setReward(Reward::get($_POST["reward"]));
        } else {
            $choice->setReward(null);
        }

        $choice->save();

        header("Location: /admin/creator/chapter/" . $choice->getChapter()->getId() . "/edit");
    });

    $router->get("/choice/(\d+)/delete", function ($choiceId) use ($router, $blade) {
        $choice = Choice::get($choiceId);
        $chapter = $choice->getChapter();
        $choice->delete();

        header("Location: /admin/creator/chapter/" . $chapter->getId() . "/edit");
    });

    $router->get("/chapter/(\d+)/addChoice", function ($chapterId) use ($router, $blade) {
        $chapter = Chapter::get($chapterId);
        echo loadPage($blade->render("admin.editChoice", ["chapter" => $chapter]), "Aggiungi scelta");
    });

    $router->post("/chapter/(\d+)/addChoice", function ($chapterId) use ($router, $blade) {
        if (!isset($_POST["optionText"]) || !isset($_POST["nextChapter"]) || !isset($_POST["requiredSkillType"]) || !isset($_POST["requiredSkillLevel"])) {
            // 400 Bad Request
            header("HTTP/1.1 400 Bad Request");
            echo "Missing optionText, nextChapter, requiredSkillType or requiredSkillLevel";
            return;
        }

        $newChoice = new Choice($_POST["optionText"], Chapter::get($_POST["nextChapter"]), SkillType::cases()[$_POST["requiredSkillType"]], $_POST["requiredSkillLevel"], null, Chapter::get($chapterId));
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

        // Check if reward is an item
        if (Item::isItem($reward)) {
            $reward = Item::get($rewardId);
        }        

        echo loadPage($blade->render("admin.editReward", ["reward" => $reward]), "Modifica ricompensa");
    });

    $router->post("/reward/(\d+)/edit", function ($rewardId) use ($router, $blade) {
        $reward = Reward::get($rewardId);

        $value = null;

        if (Item::isItem($reward)) {
            $value = $_POST["item"];
            $reward = Item::get($rewardId);
        } else {
            $value = $_POST["value"];
        }

        if (!isset($value) || !isset($_POST["description"])) {
            // 400 Bad Request
            header("HTTP/1.1 400 Bad Request");
            echo "Missing value, description";
            return;
        }

        if (!Item::isItem($reward) && !isset($_POST["affectedSkillType"])) {
            // 400 Bad Request
            header("HTTP/1.1 400 Bad Request");
            echo "Invalid affectedSkillType";
            return;
        }

        if (!Item::isItem($reward) && !is_numeric($_POST["value"])) {
            // 400 Bad Request
            header("HTTP/1.1 400 Bad Request");
            echo "Value must be a number";
            return;
        }

        if (!Item::isItem($reward) && ($_POST["affectedSkillType"] < 0 || $_POST["affectedSkillType"] >= count(SkillType::cases()))) {
            // 400 Bad Request
            header("HTTP/1.1 400 Bad Request");
            echo "Invalid affectedSkillType";
            return;
        }

        $reward->setDescription($_POST["description"]);
        if (Item::isItem($reward)) {
            $reward->setItemText($value);
        } else {
            $reward->setValue($value);
            $reward->setAffectedSkillType(SkillType::cases()[$_POST["affectedSkillType"]]);
        }
        $reward->save();

        header("Location: " . $_SERVER["REQUEST_URI"]);
    });

    $router->get("/reward/add", function () use ($router, $blade) {
        echo loadPage($blade->render("admin.editReward"), "Aggiungi ricompensa");
    });

    $router->post("/reward/add", function () use ($router, $blade) {
        if (!isset($_POST["description"]) || !isset($_POST["affectedSkillType"])) {
            // 400 Bad Request
            header("HTTP/1.1 400 Bad Request");
            echo "Missing description or affectedSkillType";
            return;
        }

        if ($_POST["affectedSkillType"] < 0 || $_POST["affectedSkillType"] >= count(SkillType::cases())) {
            // 400 Bad Request
            header("HTTP/1.1 400 Bad Request");
            echo "Invalid affectedSkillType";
            return;
        }

        // Check if reward is an item
        if (SkillType::cases()[$_POST["affectedSkillType"]] === SkillType::ITEM) {
            $newReward = new Item('', $_POST["description"]);
            $newReward->save();

            header("Location: /admin/creator/reward/" . $newReward->getId() . "/edit");
            return;
        }

        $newReward = new Reward($_POST["description"], SkillType::cases()[$_POST["affectedSkillType"]]);
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
