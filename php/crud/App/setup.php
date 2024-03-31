<?php

// require __DIR__ . "/database/koneksi.mysql.php";
require __DIR__ . "/database/koneksi.sqlite.php";
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
$list_barang = $barang->fetch();
$no = 0;