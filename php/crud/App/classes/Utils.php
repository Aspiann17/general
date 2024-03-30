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
}