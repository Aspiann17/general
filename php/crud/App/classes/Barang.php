<?php
class Barang {
    private $db, $table, $id, $nama, $stok, $harga;

    public function __construct($database ,$table) {
        $this->db = $database;
        $this->table = $table;

        if (Utils::isset("mode", "edit")) {

            if (isset($_POST["id"]) && strlen($_POST["id"]) > 0) {
                $this->id = intval($_POST["id"]);
            }
            
            if (isset($_POST["nama"]) && strlen($_POST["nama"] > 0)) {
                $this->nama = $_POST["nama"];
            }

            if (isset($_POST["id"]) && strlen($_POST["harga"]) > 0) {
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
    }

    public function fetch() {
        return $this->db->query("SELECT * FROM $this->table")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get($id) {
        $query = $this->db->query("SELECT * FROM $this->table WHERE id = :id");
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function delete() {        
        $query = $this->db->prepare("DELETE FROM $this->table WHERE id = :id");
        $query->bindParam(":id", $this->id, PDO::PARAM_INT);
        $query->execute();
    }

    public function add() {
        $query = $this->db->prepare("INSERT INTO $this->table (nama, stok, harga) VALUES (:nama, :stok, :harga)");
        $query->bindParam(":nama", $this->nama, PDO::PARAM_STR);
        $query->bindParam(":stok", $this->stok, PDO::PARAM_INT);
        $query->bindParam(":harga", $this->harga, PDO::PARAM_INT);

        $query->execute();

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
}