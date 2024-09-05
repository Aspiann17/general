<?php
$db_path = __DIR__ . "/tmp/database.sqlite";

function is_set($key, $value) : bool {
    return (
        (
            isset($_GET[$key]) && $_GET[$key] == $value
        ) || (
            isset($_POST[$key]) && $_POST[$key] == $value
        )
    ) ? true : false;
}

try {
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch (Exception $e) {
    if ($e->getCode() === 14) {
        $file_info = stat($db_path);

        echo "<pre>";
        var_dump([
            "File Permission" => [
                "User" => posix_getpwuid($file_info['uid'])['name'],
                "Group" => posix_getgrgid($file_info['gid'])['name'],
                "Permission" => substr(sprintf('%o', $file_info['mode']), -4)    
            ],
            "Message" => $e->getMessage(),
        ]);
        echo "</pre>";

        exit;
    }

    die($e->getMessage());
}

$db->exec("
    CREATE TABLE IF NOT EXISTS `siswa` (
        `nis`	INTEGER NOT NULL UNIQUE,
        `nama`	TEXT NOT NULL,
        `kelas`	TEXT,
        `jk`	TEXT,
        PRIMARY KEY(`nis` AUTOINCREMENT)
    );
");

// CRUD
if ( is_set("action", "delete") && isset($_POST["nis"]) ) {
    $stmt = $db->prepare("DELETE FROM `siswa` WHERE nis = :nis");
    $stmt->bindParam(":nis", $_POST["nis"], PDO::PARAM_INT);
    $stmt->execute();
} else if ( is_set() && is_set() ) {

}


// $db->exec("INSERT INTO siswa (nama, kelas, jk) VALUES ('kontol', 'alah', 'Pria')");
// $db->exec("DELETE FROM siswa");

$list_siswa = $db->query("SELECT * FROM `siswa`")->fetchAll(PDO::FETCH_ASSOC);


// Debug
echo "<pre>";
var_dump($_POST);
echo "</pre>";