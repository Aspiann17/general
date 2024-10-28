<?php

// Autoload Class
spl_autoload_register(function ($class) {
    require_once __DIR__ . "/classes/$class.php";
});

require "koneksi.php";
require "utils.php";

// Start Sessions
start();

$users = new Users($db);

if (is_set("action", "login")) {
    if ($users->login($_POST["username"], $_POST["password"])) {
        $_SESSION["login"] = true;
        header("location: index.php");
    }
}

else if (
    is_set("action", "register") &&
    isset($_POST["username"]) &&
    isset($_POST["email"]) &&
    isset($_POST["password"])
) {
    $users->add(
        $_POST["name"],
        $_POST["email"],
        $_POST["password"]
    );

    header("location: login.php");
};