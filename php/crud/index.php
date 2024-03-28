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
                    <tr>
                        <?php foreach (["No", "Nama Barang", "Stok", "Harga", "Action"] as $i): ?>
                            <th><?=$i?></th>
                        <?php endforeach ?>
                    </tr>
                </thead>
                <tbody>
                    <form action="" method="post">
                        <?php foreach ($barang as $b) : ?>
                            <tr>
                                <?php foreach ($b as $k => $v) : ?>
                                    <td><?=$v?></td>
                                <?php endforeach ?>

                                <?php if (isset($_GET["mode"]) && $_GET["mode"] == "edit") :?>
                                    <td><button type="submit" name="action" value="delete">Delete</button></td>
                                    <?php else : ?>
                                    <td><button type="submit" name="action" value="buy">Buy</button></td>
                                <?php endif ?>
                                <input type="hidden" name="id" value="<?=$b['id']?>">
                            </tr>
                        <?php endforeach ?>
                    </form>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>