<?php

function template(string $template, array $variables = []) : string {

    extract($variables);

    ob_start();

    require __DIR__ . "/templates/$template.php";

    return ob_get_clean();
}

function is_set($key, $value) : bool {

    if (isset($_GET[$key]) && $_GET[$key] === $value) { return true; }
    
    elseif (isset($_POST[$key]) && $_POST[$key] === $value) { return true; }
    
    elseif (isset($_SESSION[$key]) && $_SESSION[$key] === $value) { return true; }

    return false;
}

function alert(string $message) {
    echo "<script>alert('$message')</script>";
}

function start() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function check() {
    start();

    if (!is_set("login", true)) {
        header("location: login.php");
    }
}