<?php

class Utils {
    public static function isset($key, $value) : bool {
        if (isset($_GET[$key]) && $_GET[$key] == $value) {
            return true;
        } elseif (isset($_POST[$key]) && $_POST[$key] == $value) {
            return true;
        }

        return false;
    }

    public static function table_exists($database, $table_name) {
        $query = "SELECT name FROM sqlite_master WHERE type='table' AND name = :table_name";
        $stmt = $database->prepare($query);
        $stmt->execute([":table_name" => $table_name]);

        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            return true;
        }

        return false;
    }
}