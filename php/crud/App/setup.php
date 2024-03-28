<?php

require __DIR__ . "/koneksi.php";
require __DIR__ . "/autoload.php";

var_dump($_POST);

// Add Data
if (isset($_POST["action"]) && $_POST["action"] == "add") {}

elseif (isset($POST["action"]) && $_POST["action" == "delete"]) {
    
}


// Get Data
$table = "barang";
$barang = Item::fetch($table);