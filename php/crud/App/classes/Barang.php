<?php
class Barang {
    private $db, $table;
    
    public function __construct($database ,$table) {
        $this->db = $database;
        $this->table = $table;
    }

    public function fetch() {
        return $this->db->query("SELECT * FROM $this->table")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete() {
        $id = intval($_POST["id"]);
        
        $query = $this->db->prepare("DELETE FROM $this->table WHERE id=:id");
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->execute();
    }

    public function add() {
        $nama = $_POST["nama"];
        $stok = intval($_POST["stok"]);
        $harga = intval($_POST["harga"]);

        $query = $this->db->prepare("INSERT INTO $this->table (nama, stok, harga) VALUES (:nama, :stok, :harga)");
        $query->bindParam(":nama", $nama, PDO::PARAM_STR);
        $query->bindParam(":stok", $stok, PDO::PARAM_INT);
        $query->bindParam(":harga", $harga, PDO::PARAM_INT);

        $query->execute();

        return true;
    }

    public function test_add() {
        $query = $this->db->prepare("INSERT INTO $this->table (nama, stok, harga) VALUES (:nama, :stok, :harga)");
        $query->bindValue(":nama", "Tas", PDO::PARAM_STR);
        $query->bindValue(":stok", 123, PDO::PARAM_INT);
        $query->bindValue(":harga", 200000, PDO::PARAM_INT);

        $query->execute();
    }
}