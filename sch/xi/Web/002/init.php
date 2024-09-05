<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;

$db_path = __DIR__ . "/tmp/database.sqlite";

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

function is_set($key, $value) : bool {
    return (
        (
            isset($_GET[$key]) && $_GET[$key] == $value
        ) || (
            isset($_POST[$key]) && $_POST[$key] == $value
        )
    ) ? true : false;
}

function printpdf() {
    global $db;
    $pdf = new Dompdf();
    echo "ehe";
    $html = "
        <center><h3>Daftar Nama Siswa</h3></center>
        <hr/><br/>
        <table border='1' width='100%'>
            <tr>
                <td>No</td>
                <td>Nama</td>
                <td>Kelas</td>
                <td>Jenis Kelamin</td>
            </tr>
    ";

    foreach ($db->query("SELECT * FROM `siswa` ORDER BY nama ASC")->fetchAll(PDO::FETCH_ASSOC) as $i => $item) {
        $html .= "
            <tr>
                <td>$i</td>
                <td>".$item["nama"]."</td>
                <td>".$item["kelas"]."</td>
                <td>".$item["jk"]."</td>
            </tr>
        ";
    };

    $html .= "</table>";

    $pdf->loadHtml($html);
    $pdf->setPaper("A4");
    $pdf->render();
    $pdf->stream("Report.pdf");
};

$db->exec("
    CREATE TABLE IF NOT EXISTS `siswa` (
        `nis`	INTEGER NOT NULL UNIQUE,
        `nama`	TEXT NOT NULL,
        `kelas`	TEXT,
        `jk`	TEXT,
        PRIMARY KEY(`nis` AUTOINCREMENT)
    );
");

// pdf
if (is_set("action", "print")) {
    printpdf();
};

// CRUD
if ( is_set("action", "delete") && isset($_POST["nis"]) ) {
    $stmt = $db->prepare("DELETE FROM `siswa` WHERE nis = :nis");
    $stmt->bindParam(":nis", $_POST["nis"], PDO::PARAM_INT);
    $stmt->execute();
} else if ( is_set("action", "add") ) {
    if (
        (isset($_POST["input_name"]) && strlen($_POST["input_name"]) > 0) &&
        (isset($_POST["input_kelas"]) && strlen($_POST["input_kelas"]) > 0) &&
        (isset($_POST["input_jk"]) && strlen($_POST["input_jk"]) > 0)
    ) {
        $stmt = $db->prepare("INSERT INTO `siswa` (nama, kelas, jk) VALUES (:nama, :kelas, :jk)");
        $stmt->bindValue(":nama", $_POST["input_name"], PDO::PARAM_STR);
        $stmt->bindValue(":kelas", $_POST["input_kelas"], PDO::PARAM_STR);
        $stmt->bindValue(":jk", $_POST["input_jk"], PDO::PARAM_STR);
        $stmt->execute();
    };
};


// $db->exec("INSERT INTO siswa (nama, kelas, jk) VALUES ('kontol', 'alah', 'Pria')");
// $db->exec("DELETE FROM siswa");

$list_siswa = $db->query("SELECT * FROM `siswa`")->fetchAll(PDO::FETCH_ASSOC);


// Debug
echo "<pre>";
var_dump($_POST);
echo "</pre>";