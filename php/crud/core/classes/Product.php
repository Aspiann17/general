<?php
final class Product {
    private $db, $table, $id, $nama, $stok, $harga;

    public $message = array();

    public function __construct(PDO $database, string $table) {
        $this->db = $database;
        $this->table = $table;

        $this->create_table();

        // if (isset($_POST["id"]) && strlen($_POST["id"]) > 0) {
        //     $this->id = intval($_POST["id"]);
        // }

        // if (isset($_POST["nama"]) && strlen($_POST["nama"] > 0)) {
        //     $this->nama = $_POST["nama"];
        // }

        // if (isset($_POST["harga"]) && strlen($_POST["harga"]) > 0) {
        //     $this->harga = intval($_POST["harga"]);
        // }

        // if (isset($_POST["stok"]) && strlen($_POST["stok"]) > 0) {
        //     $this->stok = intval($_POST["stok"]);
        // }

        // if (Utils::isset("action", "delete")) {
        //     $this->delete();
        // } elseif (Utils::isset("action", "add")) {
        //     $this->add();
        // } elseif (Utils::isset("action", "change") && isset($this->id)) {
        //     $this->change();
        // }
    }

    public function fetch_all() : array {
        return $this->db->query("SELECT * FROM $this->table")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get(int $id) : array | bool {
        $stmt = $this->db->query("SELECT * FROM $this->table WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete(int $id) : bool {        
        $stmt = $this->db->prepare("DELETE FROM $this->table WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $this->message[] = [
                "type" => "success",
                "message" => "Produk berhasil dihapus"
            ];

            return true;
        }

        $this->message[] = [
            "type" => "error",
            "message" => "Produk gagal dihapus",
            "debug" => $stmt->errorInfo()
        ];

        return false;
    }

    public function add(string $name, ?int $stock = null, ?int $price = null) : bool {
        if (is_null($name)) {
            throw new TypeError("Tipe data $name bukan berupa string");
        }

        $stmt = $this->db->prepare("
            INSERT INTO $this->table
            (name, stock, price)
            VALUES (:name, :stock, :price)
        ");
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->bindValue(":stock", $stock ?? 0, PDO::PARAM_INT);
        $stmt->bindValue(":price", $price ?? 0, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $this->message[] = [
                "type" => "success",
                "message" => "Produk berhasil ditambahkan"
            ];

            return true;
        }

        $this->message[] = [
            "type" => "error",
            "message" => "Produk gagal ditambahkan",
            "debug" => $stmt->errorInfo()
        ];

        return false;
    }

    public function change(int $id, ?string $name = null, ?int $stock = null, ?int $price = null) {
        $user_data = $this->get($id);

        // Jika data yang akan diubah tidak ada
        if (!$user_data) {
            $this->message[] = [
                "type" => "failed",
                "message" => "Produk yang akan diubah tidak ada."
            ];

            return false;
        }

        ["name" => $name_old, "stock" => $stock_old, "price" => $price_old] = $user_data;

        $updates = [];

        if ($name !== null && $name !== $name_old) {
            $updates[] = "name = :name";
        }

        if ($stock !== null && $stock !== $stock_old) {
            $updates[] = "stock = :stock";
        }

        if ($price !== null && $price !== $price_old) {
            $updates[] = "price = :price";
        }

        if (count($updates) < 1) {
            $this->message[] = [
                "type" => "failed",
                "message" => "Tidak ada perubahan yang terjadi"
            ];

            return false;
        }

        $stmt = $this->db->prepare(
            "UPDATE $this->table SET " . implode(", ", $updates) . " WHERE id = :id"
        );

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        if ($name !== null && $name !== $name_old) {
            $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        }

        if ($stock !== null && $stock !== $stock_old) {
            $stmt->bindValue(":stock", $stock, PDO::PARAM_INT);
        }

        if ($price !== null && $price !== $price_old) {
            $stmt->bindValue(":price", $price, PDO::PARAM_INT);
        }

        // Jika data berhasil diubah
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $this->message[] = [
                "type" => "success",
                "message" => "Produk berhasil diubah"
            ];

            return true;
        }

        $this->message[] = [
            "type" => "error",
            "message" => "Produk gagal diubah",
            "debug" => $stmt->errorInfo()
        ];

        return false;
    }

    private function create_table() {
        $this->db->exec("
            CREATE TABLE IF NOT EXISTS $this->table (
                id	INTEGER NOT NULL,
                name	TEXT NOT NULL,
                stock	INTEGER DEFAULT 0,
                price	INTEGER DEFAULT 0,
                PRIMARY KEY(id)
        );");
    }
}