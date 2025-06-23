<?php

$current_page = basename($_SERVER['PHP_SELF']);

?>

<header>
    <div class="d-flex m-auto">
        <img src="../assets/img/Logo-Cimahi.PNG" alt="Logo Cimahi" class="icon-nav">
        <h1>INFO PANGAN KOTA CIMAHI</h1>
    </div>
    <nav>
        <ul>
            <li>
                <a href="index.php" class="nav-link <?= ($current_page == 'index.php') ? 'active' : ''; ?>">Beranda</a>
            </li>
            <div class="vertical-line"></div>
            <li>
                <a href="harga.php" class="nav-link <?= ($current_page == 'harga.php') ? 'active' : ''; ?>">Harga
                    Pangan</a>
            </li>
        </ul>
    </nav>
</header>