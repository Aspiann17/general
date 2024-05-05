<?php
$db_path = __DIR__ . "/toko.sqlite";

try {
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch (Exception $e) {
    die($e->getMessage());
}