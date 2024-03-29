<?php require "App/setup.php" ?>

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
                        <th class="id">ID</th>
                        <th class="barang">Nama Barang</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>
                            <?php if (Utils::isset("mode","edit")) : ?>
                                <button title="Selesai" value="complete">Selesai</button>
                            <?php else : ?>
                                    <button title="Enter edit mode" name="mode" value="edit">Edit</button>
                            <?php endif ?>
                        </th>
                    </tr>
                </form>
            </thead>
            <tbody>
                <form action="" method="post">
                    <?php foreach ($barang as $b) : ?>
                        <tr>
                            <?php foreach ($b as $k => $v) : ?>
                                <td><?=$v?></td>
                            <?php endforeach ?>

                            <?php if (Utils::isset("mode","edit")) : ?>
                                <td><button type="submit" name="action" value="delete" title="Delete item">Delete</button></td>
                            <?php else : ?>
                                <td><button type="submit" name="action" value="buy" title="Beli item">Buy</button></td>
                            <?php endif ?>

                            <?php // Parameter Tambahan ?>
                            <?php if (Utils::isset("mode","edit")) : ?>
                                <input type="hidden" name="mode" value="edit">
                            <?php endif ?>
                            <input class="hide" type="number" name="id" value="<?=$b['id']?>">
                        </tr>
                    <?php endforeach ?>

                    <?php if (Utils::isset("mode","edit")) : ?>
                        <tr>
                            <th>Add</th>
                            <td><input type="text" name="nama"></td>
                            <td><input type="number" name="stok"></td>
                            <td><input type="number" name="harga"></td>
                            <td><button value="submit">Submit</button></td>
                        </tr>
                    <?php endif ?>
                </form>
            </tbody>
        </table>
    </div>
</main>
</body>
</html>