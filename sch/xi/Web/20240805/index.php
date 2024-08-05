<?php // yang penting jadi
session_start();

if ( isset($_POST["action"]) && $_POST["action"] == "submit" ) {
    $_SESSION["data"][] = [
        "id" => $_POST["id_barang"],
        "nama" => $_POST["nama_barang"],
        "harga" => $_POST["harga_barang"],
        "merk" => $_POST["merk_barang"],
        "garansi" => $_POST["garansi_barang"],
    ];
}

$merk = [
    "Intel",
    "AMD",
    "TP-Link",
    "Tidak Ada"
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstraph</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="container mb-5">
        <h2 class="text-center m-3 ">Table Barang</h2>
        <table class="table text-center table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Merk</th>
                    <th>Garansi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>01</td>
                    <td>Power Suply 500W</td>
                    <td>50.000</td>
                    <td>Deep Cool</td>
                    <td>2 Tahun</td>
                </tr>

                <tr>
                    <td>02</td>
                    <td>Keyboard</td>
                    <td>150.000</td>
                    <td>Acome</td>
                    <td>3 Tahun</td>
                </tr>

                <tr>
                    <td>03</td>
                    <td>Ram 4GB DDR3</td>
                    <td>70.000</td>
                    <td>King Stone</td>
                    <td>Seumur hidup</td>
                </tr>

                <tr>
                    <td>04</td>
                    <td>Core 2 Duo E8400</td>
                    <td>2.000</td>
                    <td>Intel</td>
                    <td>Tidak ada</td>
                </tr>

                <tr>
                    <td>05</td>
                    <td>Motherboard G41</td>
                    <td>250.000</td>
                    <td>Random</td>
                    <td>Tidak ada</td>
                </tr>

                <tr>
                    <td>06</td>
                    <td>TL-WN722N</td>
                    <td>90.0000</td>
                    <td>TP-Link</td>
                    <td>5 Bulan</td>
                </tr>

                <?php if ( isset($_SESSION["data"])) : ?>
                    <?php foreach ($_SESSION["data"] as $data) : ?>
                        <tr>
                            <td><?=$data["id"]?></td>
                            <td><?=$data["nama"]?></td>
                            <td><?=$data["harga"];?></td>
                            <td><?=$data["merk"]?></td>
                            <td><?=$data["garansi"]?></td>
                        </tr>
                    <?php endforeach ?>
                <?php endif?>
            </tbody>
        </table>
    </div>

    <div class="container mt-4 mb-4">
        <div class="card">
            <div class="card-header bg-dark text-center text-light h4">
                Masukkan Barang
            </div>

            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="id_barang" class="form-label">ID</label>
                        <input type="number" class="form-control" id="id_barang" name="id_barang" aria-describedby="id_barang">
                    </div>

                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                            aria-describedby="nama_barang">
                    </div>

                    <div class="mb-3">
                        <label for="harga_barang" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="harga_barang" name="harga_barang"
                            aria-describedby="harga_barang">
                    </div>

                    <div class="mb-3">
                        <label for="merk" class="form-label">Merk</label>
                        <!-- <input type="text" class="form-control" id="" name="merk_barang"
                            aria-describedby="merk_barang"> -->
                        <select class="form-select" aria-label="Seleck merk" name="merk_barang">
                            <option selected>Pilih</option>
                            <?php foreach ($merk as $m) : ?>
                                <option value="<?=$m?>"><?=$m?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Garansi</label>
                        <input type="text" class="form-control" id="name" name="garansi_barang"
                            aria-describedby="garansi_barang">
                    </div>

                    <button type="submit" class="btn btn-primary" name="action" value="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>