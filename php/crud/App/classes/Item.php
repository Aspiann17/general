<?php

class Item {
    public static function fetch($table = "barang", $sss = [0,-1,1]) {
        // Start Stop Step = [0,-1,1]
        
        global $db;
        return $db->query("SELECT * FROM $table")->fetchAll(PDO::FETCH_ASSOC);
    }
}