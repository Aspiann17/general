<?php

class Users {
    private $db, $table, $username, $password;

    public $message = array();
    // Property message akan berisi Array Associative dengan dua buah kunci yaitu:
    //    type -> Tipe pesan, berupa sukses atau error.
    //    message -> Isi pesan.
    // Berfungsi untuk menampilkan pesan kepada user dan akan ditampilkan dengan alert
    // dan terletak di atas tag penutup body

    public function __construct(PDO $database, string $table = 'users') {
        $this->db = $database;
        $this->table = $table;

        $this->create_table();

        if (
            isset($_POST["username"]) && strlen($_POST["username"]) > 0 &&
            isset($_POST["password"]) && strlen($_POST["password"]) > 0
        ) {
            $this->username = $_POST["username"];
            $this->password = $_POST["password"];
        }

        if (Utils::isset("action", "login")) {

        } else if (Utils::isset("action", "register")) {
            $this->add($this->username, $this->password);
        }
    }

    public function fetch() {
        return $this->db->query(
            "SELECT * FROM $this->table"
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($username, $password) : bool {
        // Enkripsi Password
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "
            INSERT INTO $this->table
            (username, password, added)
            VALUES (:username, :password, :added)";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->bindValue(":added", time(), PDO::PARAM_INT);

        try {
            $stmt->execute();
            $this->message[] = array(
                "type" => "success",
                "message" => "Akun Berhasil Ditambahkan!"
            );
            return true;
        } catch (PDOException $e) {

            // Menangani input duplikat
            if ($e->getCode() == "23000") {
                $this->message[] = array(
                    "type" => "error",
                    "message" => "Username Sudah Ada!"
                );

                return false;
            } else { throw new PDOException($e); }
        }
    }

    private function create_table() {
        $this->db->exec("
            CREATE TABLE IF NOT EXISTS $this->table (
                id	INTEGER,
                username	TEXT NOT NULL UNIQUE,
                password	TEXT NOT NULL,
                added	INTEGER NOT NULL,
                money	INTEGER NOT NULL DEFAULT 0,
                PRIMARY KEY(id AUTOINCREMENT)
        );");
    }
}