<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../router.php";
require_once __DIR__ . "/../utils/loadPage.php";
$blade = require __DIR__ . "/../utils/blade.php";

require_once __DIR__ . "/../models/User.php";

$router->mount("/login", function () use ($router, $blade) {
    $router->get("/", function () use ($blade) {
        // If the user is already logged in, redirect to the home page
        if (isset($_SESSION["user"])) {
            header("Location: /home");
            exit();
        }


        $origin = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : "/home";

        if (strpos($origin, "/login/register") !== false) {
            header("Location: /login/register");
            exit();
        }

        // If there is an error, show it
        $error = isset($_SESSION["error"]) ? $_SESSION["error"] : null;
        unset($_SESSION["error"]);

        echo loadPage($blade->render("login", ["action" => "login", "error" => $error]), "Login");
    });

    $router->post("/", function () use ($blade) {
        // Invalid request
        if (!isset($_POST["action"])) {
            header("Location: /login");
            exit();
        }

        if ($_POST["action"] === "login") {
            // LOGIN
            if (isset($_POST["username"], $_POST["password"])) {
                $username = $_POST["username"];
                $password = $_POST["password"];

                $user = User::findByName($username);

                if (!$user || !$user->verifyPassword($password)) {
                    // Redirect to login if something went wrong
                    $_SESSION["error"] = "Username o password errati";
                    header("Location: /login");
                    exit();
                }

                $_SESSION["user"] = $user;

                // Redirect to home if everything went fine
                header("Location: /home");
                exit();
            }
        } else if ($_POST["action"] === "register") {
            // REGISTER
            if (isset($_POST["username"], $_POST["password"])) {
                $username = $_POST["username"];
                $password = $_POST["password"];

                $user = User::findByName($username);

                if ($user) {
                    // Username already in use
                    $_SESSION["error"] = "Username già in uso";
                    header("Location: /login");
                    exit();
                }

                $user = new User($username, $password);
                $user->save();

                $_SESSION["user"] = $user;

                // Redirect to home if everything went fine
                header("Location: /home");
                exit();
            }
        }

        // Redirect to login if something went wrong
        header("Location: /login");
        exit();
    });

    $router->get("/register", function () use ($blade) {
        // If there is an error, show it
        $error = isset($_SESSION["error"]) ? $_SESSION["error"] : null;
        unset($_SESSION["error"]);

        echo loadPage($blade->render("login", ["action" => "register", "error" => $error]), "Registrati");
    });

    $router->get("/logout", function () use ($blade) {
        // Destroy the session and redirect to the home page
        session_destroy();
        header("Location: /home");
        exit();
    });
});
