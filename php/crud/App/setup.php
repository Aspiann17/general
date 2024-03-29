<?php

require __DIR__ . "/koneksi.php";
require __DIR__ . "/autoload.php";

// debug
echo "GET: ";
var_dump($_GET);

echo "<br>";
echo "<br>";

echo "POST: ";
var_dump($_POST);
// end debug

$barang = new Barang($db, $table = "barang");

if (Utils::isset("action","add")) {
    if (
        Utils::isset("mode","edit") &&
        isset($_POST["nama"]) && isset($_POST["stok"]) && isset($_POST["harga"])
    ) {
        $barang->add();
    }
} elseif (Utils::isset("action","delete")) {
    $barang->delete();
}

$list_barang = $barang->fetch();