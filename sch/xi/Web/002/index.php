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
            <h3 id="main_title">SCRUD</h3>
            <div class="d-flex">
                <button id="edit_button" type="button" class="btn btn-secondary mx-2" data-bs-toggle="modal"
                    data-bs-target="#modal_data">
                    Edit
                </button>

                <button id="add_button" type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#modal_data">
                    Tambah
                </button>

            </div>
        </div>

        <hr>

        <table id="main_table" class="table table-dark table-striped-columns text-center">
            <thead>
                <tr>
                    <td>Nis</td>
                    <td>Nama</td>
                    <td>jk</td>
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

        <div class="modal fade" id="modal_data" tabindex="-1" aria-labelledby="modal_data" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modal_title"></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="input_nis">NIS</label>
                                <select class="form-control" id="input_nis" name="input_nis" disabled></select>
                            </div>

                            <div class="mb-3">
                                <label for="input_name">Nama</label>
                                <input type="text" class="form-control" id="input_name" name="input_name">
                            </div>

                            <div class="mb-3">
                                <label for="input_kelas">Kelas</label>
                                <select class="form-control" name="input_kelas">
                                    <option selected>-</option>
                                    <option value="x">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="input_jk">Jenis Kelamin</label>
                                <select class="form-control" name="input_jk">
                                    <option selected>-</option>
                                    <option value="pria">Pria</option>
                                    <option value="wanita">Wanita</option>
                                    <option value="pria">Stainless Steel</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="modal_button" name="action">-</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../bootstrap/bootstrap.min.js"></script>
    <script>
        const modal_title = document.getElementById("modal_title");
        const modal_button = document.getElementById("modal_button");
        const input_name = document.getElementById("input_name");
        const input_kelas = document.getElementById("input_kelas");
        const input_jk = document.getElementById("input_jk");
        const input_nis = document.getElementById("input_nis");
        const array_nis = Array.from(document.querySelectorAll(
            "input[type='hidden'][name='nis']"
        )).map(input => input.value);

        document.getElementById("add_button").addEventListener("click", () => {
            modal_title.textContent = "Tambahkan Data";
            modal_button.textContent = "Tambah"
            modal_button.setAttribute("value", "add");
            input_nis.disabled = true;
            input_nis.innerHTML = "";
        });

        document.getElementById("edit_button").addEventListener("click", () => {
            modal_title.textContent = "Edit Data";
            modal_button.textContent = "Edit";
            modal_button.setAttribute("value", "update");
            input_nis.disabled = false;
            input_nis.innerHTML = "";

            array_nis.forEach(item => {
                const option = document.createElement("option");
                option.value = item;
                option.text = item;
                document.getElementById("input_nis").appendChild(option);
            });
        });

    <script src="../bootstrap/bootstrap.min.js">

    </script>
</body>

</html>