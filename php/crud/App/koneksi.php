<?php

try {
    $db = new PDO("sqlite:database/shop.sqlite");
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch (Exception $e) {
    die($e->getMessage());
}