<?php

$current_page = trim($_GET['route'] ?? "", "/");

?>

<header>
    <div class="d-flex m-auto">
        <img src="assets/img/Logo-Cimahi.PNG" alt="Logo Cimahi" class="icon-nav">
        <h1>INFO PANGAN KOTA CIMAHI</h1>
    </div>
    <nav>
        <ul>
            <li>
                <a href="index.php" class="nav-link <?= ($current_page == '') ? 'active' : ''; ?>">Beranda</a>
            </li>
            <div class="vertical-line"></div>
            <li>
                <a href="index.php?route=/harga" class="nav-link <?= ($current_page == 'harga') ? 'active' : ''; ?>">Harga
                    Pangan</a>
            </li>
            <li>
                <a href="index.php?route=/admin" class="nav-link">Panel Admin</a>
            </li>
        </ul>
    </nav>
</header>