<?php

require __DIR__ . "/../core/init.php";

// debug
echo "GET: ";
var_dump($_GET);

echo "<br>";
echo "<br>";

echo "POST: ";
var_dump($_POST);
// end debug

$users = new Users($db);