<?php
class Barang {
    private $db, $table, $id, $nama, $stok, $harga;

    public function __construct(PDO $database, string $table) {
        $this->db = $database;
        $this->table = $table;

        $this->create_table();

        if (isset($_POST["id"]) && strlen($_POST["id"]) > 0) {
            $this->id = intval($_POST["id"]);
        }

        if (isset($_POST["nama"]) && strlen($_POST["nama"] > 0)) {
            $this->nama = $_POST["nama"];
        }

        if (isset($_POST["harga"]) && strlen($_POST["harga"]) > 0) {
            $this->harga = intval($_POST["harga"]);
        }

        if (isset($_POST["stok"]) && strlen($_POST["stok"]) > 0) {
            $this->stok = intval($_POST["stok"]);
        }

        if (Utils::isset("action", "delete")) {
            $this->delete();
        } elseif (Utils::isset("action", "add")) {
            $this->add();
        } elseif (Utils::isset("action", "change") && isset($this->id)) {
            $this->change();
        }
    }

    public function fetch() : array {
        return $this->db->query("SELECT * FROM $this->table")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get(int $id) : array {
        $stmt = $this->db->query("SELECT * FROM $this->table WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete() {        
        $stmt = $this->db->prepare("DELETE FROM $this->table WHERE id = :id");
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function add() : bool {
        if (!$this->nama) {
            return false;
        }
        
        $stmt = $this->db->prepare("INSERT INTO $this->table (nama, stok, harga) VALUES (:nama, :stok, :harga)");
        $stmt->bindValue(":nama", $this->nama, PDO::PARAM_STR);
        $stmt->bindValue(":stok", $this->stok ?? 0, PDO::PARAM_INT);
        $stmt->bindValue(":harga", $this->harga ?? 0, PDO::PARAM_INT);

        $stmt->execute();

        return true;
    }

    public function change() {
        ["nama" => $nama, "stok" => $stok, "harga" => $harga] = $this->get($this->id);

        $query = "UPDATE $this->table SET nama = :nama, stok = :stok, harga = :harga WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":nama", ($this->nama ?? $nama), PDO::PARAM_STR);
        $stmt->bindValue(":stok", ($this->stok ?? $stok), PDO::PARAM_INT);
        $stmt->bindValue(":harga", ($this->harga ?? $harga), PDO::PARAM_INT);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        $stmt->execute();
    }

    private function create_table() {
        $query = "
            CREATE TABLE IF NOT EXISTS $this->table (
                id	INTEGER NOT NULL,
                nama	TEXT NOT NULL,
                stok	INTEGER DEFAULT 0,
                harga	INTEGER DEFAULT 0,
                PRIMARY KEY(id)
            );";
        $this->db->exec($query);
    }
}