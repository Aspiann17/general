<?php

// Autoload Class
spl_autoload_register(function ($class) {
    require_once __DIR__ . "/classes/$class.php";
});

require "koneksi.php";
require "utils.php";
require "vendor/autoload.php";

// Start Sessions
start();

$users = new Users($db);

if (is_set("action", "login")) {
    if ($users->login($_POST["username"], $_POST["password"])) {
        $_SESSION["login"] = true;
        $_SESSION["username"] = $_POST["username"];

        header("location: index.php");
    }
}

else if (
    is_set("action", "register") &&
    isset($_POST["username"]) &&
    isset($_POST["password"])
) {
    if ($users->add($_POST["username"],  $_POST["password"])) {
        header("location: login.php");
    }

}

else if (is_set("action", "logout")) {
    session_destroy();
    header("location: login.php");
}