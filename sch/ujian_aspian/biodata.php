<?php
require "utils.php";
check();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?= template("meta") ?>
    <title>Biodata</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <style>
        @media print {
            .hide {
                display: none;
            }
        }

        /* Template */
        .card {
            border: none;
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            cursor: pointer;
        }

        .card:before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background-color: gray;
            transform: scaleY(1);
            transition: all 0.5s;
            transform-origin: bottom
        }

        .card:after {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background-color: black;
            transform: scaleY(0);
            transition: all 0.5s;
            transform-origin: bottom
        }

        .card:hover::after {
            transform: scaleY(1);
        }

        .fonts {
            font-size: 11px;
        }

        .social-list {
            display: flex;
            list-style: none;
            justify-content: center;
            padding: 0;
        }

        .social-list li {
            padding: 10px;
            font-size: 19px;
        }

        .card-body {
            background-color: #eaeaea !important;
        }
        /* End Template */
    </style>
</head>

<body>
    <!-- Nav Bar -->
    <?= template("navbar") ?>

    <div id="layoutSidenav">

        <!-- Side Bar -->
        <?= template("sidepanel") ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Biodata</h1>
                    <div class="card mb-4">
                        <div class="card-body">

                            <!-- Template -->
                            <div class="container mt-5">
                            <div class="row d-flex justify-content-center">
                            <div class="col-md-7">
                            <div class="card p-3 py-4">

                                <div class="text-center">
                                    <img src="https://i.imgur.com/bDLhJiP.jpg" width="100" class="rounded-circle">
                                </div>

                                <div class="text-center mt-3">
                                    <span class="bg-secondary p-1 px-4 rounded text-white">X RPL 2</span>
                                    <h5 class="mt-2 mb-0">Muhammad Aspian</h5>
                                    <span>Programmer</span>

                                    <div class="px-4 mt-1">
                                        <p class="fonts"></p>
                                    </div>

                                    <ul class="social-list">
                                        <li><i class="fa-brands fa-facebook text-primary"></i></li>
                                        <li><i class="fa-brands fa-github"></i></li>
                                    </ul>
                                </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            <!-- End Template -->
                            <button class="btn btn-primary hide" onclick="window.print()">Print</button>
                        </div>
                    </div>
                </div>
            </main>
            <?= template("footer") ?>
        </div>
    </div>
    <?= template("js") ?>
</body>

</html>