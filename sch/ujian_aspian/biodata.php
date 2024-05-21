<?php require "utils.php" ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Biodata</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        <style>
            @media print {
                .hide {
                    display: none;
                }
            }
        </style>
    </head>
    <body>
        <!-- Nav Bar -->
        <?=template("navbar")?>
        
        <div id="layoutSidenav">

            <!-- Side Bar -->
            <?=template("sidepanel")?>
            
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Biodata</h1>
                        <!-- <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Static Navigation</li>
                        </ol> -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <p class="mb-0"></p>
                                <button class="btn btn-primary hide" onclick="window.print()">Print</button>
                            </div>
                        </div>
                    </div>
                </main>
                <?=template("footer")?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
