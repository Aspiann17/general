<?php

function template(string $template, array $variables = []) : string {

    extract($variables);

    ob_start();

    require __DIR__ . "/../assets/templates/$template.php";

    return ob_get_clean();
}

function is_set($key, $value) : bool {

    if (isset($_GET[$key]) && $_GET[$key] === $value) return true;

    elseif (isset($_POST[$key]) && $_POST[$key] === $value) return true;

    elseif (isset($_SESSION[$key]) && $_SESSION[$key] === $value) return true;

    return false;
}

function alert(string $message) : void {
    echo "<script>alert('$message')</script>";
}

function start() : void {
    if (session_status() === PHP_SESSION_NONE) session_start();
}

function check() : void {
    start();

    if (!is_set("login", true)) {
        header("location: login.php");
    }
}


function dump() : void {
    echo "<pre>";
    var_dump($_GET, $_POST);
    echo "</pre>";
}