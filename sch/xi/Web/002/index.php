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

        <form method="post">
            <div class="d-flex flex-row mt-5 justify-content-between">
                <h3 id="main_title">SCRUD</h3>
                <div class="d-flex">
                    <button type="submit" name="action" value="generate"
                        class="btn btn-secondary mx-2">Generate</button>

                    <button type="button" class="btn btn-danger mx-2" data-bs-toggle="modal"
                        data-bs-target="#modal_verify">Reset</button>

                    <button type="submit" name="action" value="print" class="btn btn-success mx-2">Print</button>

                    <button id="edit_button" type="button" class="btn btn-warning mx-2" data-bs-toggle="modal"
                        data-bs-target="#modal_data">Edit</button>

                    <button id="add_button" type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modal_data">Tambah</button>

                </div>
            </div>
        </form>

        <hr>

        <table id="main_table" class="table table-dark table-striped-columns text-center">
            <thead>
                <tr>
                    <td>Nis</td>
                    <td>Nama</td>
                    <td>Kelas</td>
                    <td>Jenis Kelamin</td>
                    <td>-</td>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($list_siswa as $siswa): ?>
                    <tr>
                        <td class="nis"><?= $siswa["nis"] ?></td>
                        <td><?= $siswa["nama"] ?></td>
                        <td><?= $siswa["kelas"] ?></td>
                        <td><?= $siswa["jk"] ?></td>
                        <td><a href="?action=delete&nis=<?=$siswa['nis']?>"><button class="btn btn-dark">Delete</button></a></td>
                        <input type="hidden" name="nis" value="<?= $siswa['nis'] ?>">
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <!-- Create, Update Modal -->
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
                                <select class="form-control" name="input_kelas" id="input_kelas">
                                    <option selected>-</option>
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="input_jk">Jenis Kelamin</label>
                                <select class="form-control" name="input_jk" id="input_jk">
                                    <option selected>-</option>
                                    <option value="Pria">Pria</option>
                                    <option value="Wanita">Wanita</option>
                                    <option value="Stainless Steel">Stainless Steel</option>
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

        <!-- Verify Modal -->
        <div class="modal fade" id="modal_verify" tabindex="-1" aria-labelledby="modal_verify" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Semua Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed nisi fugit quod voluptate
                            accusamus ab, qui saepe vero incidunt! Neque blanditiis omnis laboriosam rem aliquid. Nulla,
                            atque maxime! Molestiae, distinctio?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                        <form method="post">
                            <button type="submit" name="action" value="reset" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.bootstrap5.js"></script>
    <script>
        let main_table = new DataTable("#main_table");
    </script>

    <script src="../bootstrap/bootstrap.min.js"></script>
    <script>
        // Membersihkan semua key/value pada search bar.
        // window.onload = () => window.history.replaceState({}, document.title, window.location.pathname);

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
            input_nis.innerHTML = "";

            if (array_nis.length < 1) {
                input_nis.disabled = true;
                input_name.disabled = true;
                input_kelas.disabled = true;
                input_jk.disabled = true;
            } else {
                input_nis.disabled = false;
                array_nis.forEach(item => {
                    const option = document.createElement("option");
                    option.value = item;
                    option.text = item;
                    input_nis.appendChild(option);
                });
            };
        });

        // input_nis.addEventListener("change", (event) => {
        //     console.log("astagfirullah");
        //     const nis = event.target.value;
        //     const rows = document.querySelectorAll("#main_table tbody tr");

        //     rows.forEach(row => {
        //         const cells = row.getElementsByTagName('td');

        //         if (cells[0].textContent === nis) {
        //             input_name.textContent = cells[1].textContent;
        //             // input_kelas.textContent = cells[2].textContent;
        //         };
        //     });
        // })
    </script>
</body>

</html>