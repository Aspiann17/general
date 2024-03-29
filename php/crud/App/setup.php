<?php

require __DIR__ . "/koneksi.php";
require __DIR__ . "/autoload.php";

echo "GET: ";
var_dump($_GET);

echo "<br>";
echo "<br>";

echo "POST: ";
var_dump($_POST);

// Add Data
if (Utils::isset("action","add")) {}

elseif (Utils::isset("action","delete")) {}


// Get Data
$table = "barang";
$barang = Item::fetch($table);