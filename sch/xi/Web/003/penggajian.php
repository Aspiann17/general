<?php
require "core/init.php";
check();

$BULAN = [
    "januari",
    "februari",
    "maret",
    "april",
    "mei",
    "juni",
    "juli",
    "agustus",
    "september",
    "oktober",
    "november",
    "desember"
];

$stmt = $db->prepare("SELECT * FROM karyawan JOIN golongan ON karyawan.kode_golongan = golongan.kode_golongan");
$stmt->execute();
$karyawan = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<?= template("head", ["title" => "Penggajian"]) ?>

<script>
    let gaji = []
</script>

<body class="sb-nav-fixed">
    <?= template("navbar") ?>

    <div id="layoutSidenav">

        <?= template("sidebar") ?>

        <div id="layoutSidenav_content">

            <div class="container px-4 mt-4">
                <h3>Penggajian Karyawan</h3><br>
                <div class="card">
                    <div class="card-header bg-secondary text-light">
                        Buat Slip Gaji
                    </div>

                    <div class="card-body">
                        <form action="php/print_pdf.php" method="POST">
                            <label for="bulan">Bulan</label>
                            <select name="bulan" class="form-control mb-2" id="bulan">
                                <?php foreach ($BULAN as $b) : ?>
                                    <option value="<?= $b ?>">
                                        <?= ucfirst($b) ?>
                                    </option>
                                <?php endforeach ?>
                            </select>

                            <label for="karyawan_id">Nama Karyawan</label>
                            <select class="form-control mb-2" name="karyawan_id" id="karyawan_id">

                                <?php foreach ($karyawan as $k) : ?>
                                    <option value="<?= $k['nip'] ?>">
                                        <?= $k['nama'] ?> (Golongan: <?= $k['golongan'] ?>)
                                    </option>

                                    <script>
                                        gaji["<?= $k["nip"] ?>"] = <?= $k["gaji_pokok"] ?>
                                    </script>
                                <?php endforeach ?>

                            </select>

                            <input type="hidden" name="golongan" id="golongan" value="III/A">

                            <label for="gaji_pokok">Gaji Pokok</label>
                            <input type="number" name="gaji_pokok" value="2000" id="gaji_pokok" class="form-control mb-2" disabled>

                            <label for="tunjangan_jabatan">Tunjangan Jabatan</label>
                            <select class="form-control mb-2" name="tunjangan_jabatan" id="tunjangan_jabatan">
                                <option value="0">Tidak ada</option>
                                <option value="500000">Kepala Bagian</option>
                                <option value="250000">Staff</option>
                            </select>

                            <hr>
                            <p class="fw-bold">Tunjangan Lainnya</p>

                            <label for="tunjangan_nikah">Menikah</label>
                            <select class="form-control mb-2" name="tunjangan_nikah" id="tunjangan_nikah">
                                <option value="0">Belum</option>
                                <option value="250000">Sudah</option>
                            </select>

                            <label for="tunjangan_anak">Tunjangan Anak</label><br>
                            <input checked disabled class="form-check-input" type="radio" name="tunjangan_anak" value="0" id="anak_0">
                            <label for="anak_0">Tidak ada</label>

                            <input disabled class="form-check-input" type="radio" name="tunjangan_anak" value="200000" id="anak_1">
                            <label for="anak_1">1 Anak</label>

                            <input disabled class="form-check-input" type="radio" name="tunjangan_anak" value="400000" id="anak_2">
                            <label for="anak_2">2 Anak</label>

                            <hr>
                            <p class="fw-bold">Potongan</p>
                            <blockquote class="fw-bold fst-italic text-danger" style="font-family: monospace;">
                                * Potongan BPJS Kesehatan Sebesar Rp.34.000,- <br>
                                * Potongan Pajak 15% bagi Golongan IV, dan 5% bagi Golongan III
                            </blockquote>

                            <hr>
                            <p class="fw-bold">Rincian Slip Gaji</p>
                            <table class="table">
                                <tr>
                                    <td>Gaji</td>
                                    <td><input type="text" name="gaji" id="gaji" class="form-control-plaintext" value="Rp.0" readonly></td>
                                </tr>
                                <tr>
                                    <td>Tunjangan Jabatan</td>
                                    <td><input type="text" name="jabatan" id="jabatan" class="form-control-plaintext" value="Rp.0" readonly></td>
                                </tr>
                                <tr>
                                    <td>Tunjangan Suami</td>
                                    <td><input type="text" name="nikah" id="nikah" class="form-control-plaintext" value="Rp.0" readonly></td>
                                </tr>
                                <tr>
                                    <td>Tunjangan Anak</td>
                                    <td><input type="text" name="anak" id="anak" class="form-control-plaintext" value="Rp.0" readonly></td>
                                </tr>
                                <tr>
                                    <td>Potongan BPJS</td>
                                    <td><input type="text" name="bpjs" id="bpjs" class="form-control-plaintext" value="Rp.0" readonly></td>
                                </tr>
                                <tr>
                                    <td>Potongan Pajak</td>
                                    <td><input type="text" name="pajak" id="pajak" class="form-control-plaintext" value="Rp.0" readonly></td>
                                </tr>
                                <tr class="fw-bold">
                                    <td>Gaji Bersih</td>
                                    <td><input type="text" name="gaji_bersih" id="gaji_bersih" class="form-control-plaintext" value="Rp.0" readonly></td>
                                </tr>
                            </table>

                            <button id="calculate" type="button" class="form-control btn btn-primary mt-1 text-white" onclick="hitung()">Hitung Pendapatan</button>
                            <!-- <input type="submit" class="form-control btn btn-success mb-3 mt-1" value="Buat Slip"> -->
                        </form>
                    </div>

                </div>
            </div>

            <?= template("footer") ?>

        </div>
    </div>

    <?= template("js") ?>
    <script>
        function hitung() {
            let golongan = document.getElementById("golongan").value;
            let gapok = parseInt(document.getElementById("gaji_pokok").value);
            let tunjab = parseInt(document.getElementById("tunjangan_jabatan").value);
            let tunjangan1 = parseInt(document.getElementById("tunjangan_nikah").value);
            let anak = document.querySelector("input[name='tunjangan_anak']:checked");

            let tunjangan2 = 0;
            if (anak) {
                tunjangan2 = parseInt(anak.value);
            }

            let bpjs = 34000;

            let pendapatan = Number(gapok + tunjab + tunjangan1 + tunjangan2);
            let bersih = 0;
            let potongan = 0;

            const arr = golongan.split("/");
            let gol = arr[0];
            if (gol == "III") {
                potongan = pendapatan * 0.05;
                bersih = pendapatan - (potongan + bpjs);
            } else if (gol == "IV") {
                potongan = pendapatan * 0.15;
                bersih = pendapatan - (potongan + bpjs);
            }

            document.getElementById("gaji").value = "Rp." + (new Intl.NumberFormat().format(gapok));
            document.getElementById("jabatan").value = "Rp." + (new Intl.NumberFormat().format(tunjab));
            document.getElementById("nikah").value = "Rp." + (new Intl.NumberFormat().format(tunjangan1));
            document.getElementById("anak").value = "Rp." + (new Intl.NumberFormat().format(tunjangan2));
            document.getElementById("bpjs").value = "Rp." + (new Intl.NumberFormat().format(bpjs));
            document.getElementById("pajak").value = "Rp." + (new Intl.NumberFormat().format(potongan));
            document.getElementById("gaji_bersih").value = "Rp." + (new Intl.NumberFormat().format(bersih));
        }
    </script>

    <script>
        let tunjangan_jabatan = document.getElementById("tunjangan_jabatan")
        let tunjangan_menikah = document.getElementById("tunjangan_nikah")
        let tunjangan_anak = document.querySelector("input[name='tunjangan_anak']:checked")
        let gaji_pokok = document.getElementById("gaji_pokok")
        let golongan = document.getElementById("golongan")
        let bersih = pendapatan = potongan = 0
        const bpjs = 34000;

        let output = [];

        tunjangan_menikah.addEventListener("change", () => {
            document.querySelectorAll("input[name='tunjangan_anak']").forEach((radio) => {
                radio.disabled = tunjangan_menikah.value === "0"
            })

            document.getElementById("anak_0").checked = true
        })

        document.getElementById("calculate").addEventListener("click", () => {
            gaji_pokok = parseInt(gaji_pokok.value) || 0
            // golongan = golongan.value || 0
            tunjangan_jabatan = parseInt(tunjangan_jabatan.value) || 0
            tunjangan_menikah = parseInt(tunjangan_menikah.value) || 0
            tunjangan_anak = parseInt(tunjangan_anak.value) || 0
            pendapatan = Number(gaji_pokok + tunjangan_jabatan + tunjangan_menikah + tunjangan_anak)

            switch (golongan.value.split("/")[0]) {
                case "III":
                    bersih = pendapatan - ((pendapatan * 0.05) + bpjs)
                    break
                case "IV":
                    bersih = pendapatan - ((pendapatan * 0.15) + bpjs)
                    break
            }

            [
                ["gaji", gaji_pokok],
                ["jabatan", tunjangan_jabatan],
                ["nikah", tunjangan_menikah],
                ["anak", tunjangan_anak],
                ["bpjs", bpjs],
                ["pajak", potongan],
                ["gaji_bersih", bersih]
            ].forEach(([key, value]) => {
                output[key] = new Intl.NumberFormat("id-ID").format(value)
            })

            console.log(output)
        })
    </script>
</body>

</html>