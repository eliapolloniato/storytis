<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../router.php";
require_once __DIR__ . "/../utils/loadPage.php";
$blade = require __DIR__ . "/../utils/blade.php";

$router->mount("/login", function () use ($router, $blade) {
    $router->get("/", function () use ($blade) {
        echo loadPage($blade->render("login", ["action" => "login"]), "Login");
    });

    $router->post("/", function () use ($blade) {
        if (!isset($_POST["action"])) {
            header("Location: /login");
            exit();
        }

        if ($_POST["action"] === "login") {
            // LOGIN
            if (isset($_POST["username"], $_POST["password"])) {
                $username = $_POST["username"];
                $password = $_POST["password"];

                // TODO: check if the user exists and the password is correct
                $user = null;

                $_SESSION["user"] = $user;
            }
        } else if ($_POST["action"] === "register") {
            // REGISTER
            if (isset($_POST["username"], $_POST["password"])) {
                $username = $_POST["username"];
                $password = $_POST["password"];

                // TODO: create user
                $user = null;

                $_SESSION["user"] = $user;
            }
        }
    });

    $router->get("/register", function () use ($blade) {
        echo loadPage($blade->render("login", ["action" => "register"]), "Registrati");
    });

    $router->get("/logout", function () use ($blade) {
        // Destroy the session and redirect to the home page
        session_destroy();
        header("Location: /home");
        exit();
    });
});
