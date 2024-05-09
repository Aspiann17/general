<?php
require __DIR__ . "/../core/init.php";

if (!isset($_SESSION["login"])) {
    header("location:../users");
}

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