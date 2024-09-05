<?php require "init.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L002</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="d-flex flex-row mt-5 justify-content-between">
            <h3 class="">SCRUD</h3>
            <div class="d-flex">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_data">
                    Tambah Data
                </button>

            </div>
        </div>

        <hr>

        <table class="table table-dark table-striped-columns text-center">
            <thead>
                <tr>
                    <td>Nis</td>
                    <td>Nama</td>
                    <td>Kelas</td>
                    <td>Jenis Kelamin</td>
                    <td>Aksi</td>
                </tr>
            </thead>

            <tbody>
                <!-- <tr>
                    <td>1</td>
                    <td>Fulan</td>
                    <td>X RPL</td>
                    <td>Stainless Steel</td>
                    <td><button class="btn btn-dark">Delete</button></td>
                </tr> -->

                <?php foreach ($list_siswa as $siswa): ?>
                    <form method="post">
                        <tr>
                            <td><?= $siswa["nis"] ?></td>
                            <td><?= $siswa["nama"] ?></td>
                            <td><?= $siswa["kelas"] ?></td>
                            <td><?= $siswa["jk"] ?></td>
                            <td><button class="btn btn-dark" name="action" value="delete">Delete</button></td>
                        </tr>
                        <input type="hidden" name="nis" value="<?= $siswa['nis'] ?>">
                    </form>
                <?php endforeach ?>
            </tbody>
        </table>

        <div class="modal fade" id="modal_data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modal_title"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="mb-3">
                            <label for="input_nis">NIS</label>
                            <input type="text" class="form-control" id="input_nis">
                        </div>

                        <div class="mb-3">
                            <label for="input_name">Nama</label>
                            <input type="text" class="form-control" id="input_name">
                        </div>

                        <div class="mb-3">
                            <label for="input_kelas">Kelas</label>
                            <select class="form-control" name="input_kelas">
                                <option>-</option>
                                <option value="x">X</option>
                                <option value="XI">XI</option>
                                <option value="XII">XII</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="input_jk">Jenis Kelamin</label>
                            <select class="form-control" name="input_jk">
                                <option>-</option>
                                <option value="pria">Pria</option>
                                <option value="wanita">Wanita</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="modal_button">-</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="../bootstrap/bootstrap.min.js">

    </script>
</body>

</html>