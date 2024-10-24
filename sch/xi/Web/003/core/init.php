<?php

// Autoload Class
spl_autoload_register(function ($class) {
    require_once __DIR__ . "/classes/$class.php";
});

require "utils.php";