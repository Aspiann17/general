<?php require __DIR__ . "/App/setup.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<main>
    <div class="container">
        <table border="10" class="main">
            <thead>
                <form action="" method="get">
                    <tr>
                        <th class="id"><?= (Utils::isset("mode","edit")) ? "ID" : "No" ?></th>
                        <th class="barang">Nama Barang</th>
                        <th class="stok">Stok</th>
                        <th class="harga">Harga</th>
                        <th class="button">
                            <?php if (Utils::isset("mode","edit")) : ?>
                                <button title="Selesai" value="complete">Complete</button>
                            <?php else : ?>
                                    <button title="Enter edit mode" name="mode" value="edit">Edit</button>
                            <?php endif ?>
                        </th>
                    </tr>
                </form>
            </thead>
            <tbody>
                <?php $i = 0;?>
                <?php foreach ($list_barang as $b) : 
                    $i++
                ?>
                    <form action="" method="post">
                        <tr>
                            <td><?= (Utils::isset("mode","edit")) ? $b["id"] : $i ?></td>
                            <td><?= $b["nama"] ?></td>
                            <td><?= $b["stok"] ?></td>
                            <td><?= $b["harga"] ?></td>

                            <?php if (Utils::isset("mode","edit")) : ?>
                                <td><button type="submit" name="action" value="delete" title="Hapus Barang">Delete</button></td>
                            <?php else : ?>
                                <td><button type="submit" name="action" value="buy" title="Beli Barang">Buy</button></td>
                            <?php endif ?>

                            <?php if (Utils::isset("mode","edit")) : ?>
                                <input type="hidden" name="mode" value="edit">
                            <?php endif ?>

                            <input type="hidden" name="id" value="<?=$b["id"]?>">
                        </tr>
                    </form>
                <?php endforeach ?>

                <?php // Add ?>
                <?php if (Utils::isset("mode","edit")) : ?>
                    <form action="" method="post">
                        <input type="hidden" name="mode" value="edit">
                        <tr class="add">
                            <th>-</th>
                            <td><input type="text" name="nama" autocomplete="off" required></td>
                            <td><input type="number" name="stok"></td>
                            <td><input type="number" name="harga"></td>
                            <td><button type="submit" name="action" value="add">Add</button></td>
                        </tr>
                    </form>
                    <form action="" method="post">
                        <tr class="change">
                            <td><input type="number" name="id" required></td>
                            <td><input type="text" name="nama" autocomplete="off"></td>
                            <td><input type="number" name="stok"></td>
                            <td><input type="number" name="harga"></td>
                            <td><button type="submit" name="action" value="change">Change</button></td>
                        </tr>
                    </form>
                <?php endif ?>

                <!-- Backpack -->
                <?php if (!Utils::isset("mode", "edit")) : ?>
                    <tr>
                        <th colspan="5">Wallet</th>
                    </tr>

                    <tr>
                        <th colspan="5">Backpack</th>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</main>
</body>
</html>