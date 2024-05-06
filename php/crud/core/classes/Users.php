<?php

class Users {
    private $db, $table;

    public $message = array();
    // Property message akan berisi Array Associative dengan dua buah kunci yaitu:
    //    type -> Tipe pesan, berupa sukses atau gagal.
    //    message -> Isi pesan.
    // Berfungsi untuk menampilkan pesan kepada user dan akan ditampilkan dengan alert
    // dan terletak di atas tag penutup body

    public function __construct(PDO $database, string $table = 'users') {
        $this->db = $database;
        $this->table = $table;

        $this->create_table();

        if (
            isset($_POST["username"], $_POST["password"]) &&
            strlen($_POST["username"]) > 0 && strlen($_POST["username"]) > 0
        ) {
            $username = $_POST["username"];
            $password = $_POST["password"];

            if (Utils::isset("action", "login")) {
                $this->login($username, $password);
            } else if (Utils::isset("action", "register")) {
                $this->add($username, $password);
            }
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

        $stmt = $this->db->prepare("
            INSERT INTO $this->table
            (username, password, added)
            VALUES (:username, :password, :added)"
        );
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
                    "type" => "failed",
                    "message" => "Username Sudah Ada!",
                    "debug" => $e
                );

                return false;
            } else {
                $this->message[] = array(
                    "type" => "failed",
                    "error_code" => $e->getCode(),
                    "message" => $e
                );
                return false;
            }
        }
    }

    public function login(string $username, string $password) : bool {
        // Memeriksa hasil query apakah ada
        $hassword = $this->get_password($username);

        if (is_null($hassword)) {
            $this->message[] = array(
                "type" => "failed",
                "message" => "Username Tidak Ada!"
            );

            return false;
        }

        // Varifikasi Password apakah sama dengan yang ada di database
        else if (!password_verify($password, $hassword)) {
            $this->message[] = array(
                "type" => "failed",
                "message" => "Password Salah!"
            );

            return false;
        }

        $this->message[] = array(
            "type" => "success",
            "message" => "Login Berhasil!"
        );

        return true;
    }

    public function get_password(string $username) : string | null {
        $stmt = $this->db->prepare("
            SELECT password FROM $this->table
            WHERE username = :username"
        );
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)["password"] ?? null;
    }

    private function create_table() {
        $this->db->exec("
            CREATE TABLE IF NOT EXISTS $this->table (
                id	INTEGER,
                username	TEXT NOT NULL UNIQUE,
                password	TEXT NOT NULL,
                added	INTEGER NOT NULL,
                access	VARCHAR(8) NOT NULL DEFAULT 'users',
                money	INTEGER NOT NULL DEFAULT 0,
                PRIMARY KEY(id AUTOINCREMENT)
        );");
    }
}