<?php

try {
    $db = new PDO("sqlite:database/toko.sqlite");
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch (Exception $e) {
    die($e->getMessage());
}