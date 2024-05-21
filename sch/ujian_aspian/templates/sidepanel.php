<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link" href="index.php">
                    <div class="sb-nav-link-icon"><i class="far fa-file-code"></i></div>
                    Dashboard
                </a>
                
                <a class="nav-link" href="biodata.php">
                    <div class="sb-nav-link-icon"><i class="far fa-file"></i></div>
                    Biodata
                </a>

                <a class="nav-link" href="https://github.com/Aspiann17">
                    <div class="sb-nav-link-icon"><i class="fas fa-code-branch"></i></div>
                    Github
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <?php start() ?>
            <?=$_SESSION["username"] ?? "Guest"?>
        </div>
    </nav>
</div>