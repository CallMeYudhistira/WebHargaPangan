<?php

$current_page = trim($_GET['route'] ?? "", "/");

?>

<header style="border-bottom: 1px solid #ccc; max-height: 100px; margin-top: -10px;">
    <div class="container app-bar">
        <div class="d-flex m-auto">
            <img src="assets/img/Logo-Cimahi.PNG" alt="Logo Cimahi" class="icon-nav">
            <h1>INFO PANGAN KOTA CIMAHI</h1>
        </div>
        <nav class="nav-menu">
            <ul class="nav-item">
                <li>
                    <a href="index.php" class="nav-link <?= ($current_page == '') ? 'active' : ''; ?>">Beranda</a>
                </li>
                <div class="vertical-line"></div>
                <li>
                    <a href="index.php?route=/komoditas"
                        class="nav-link <?= ($current_page == 'komoditas') ? 'active' : ''; ?>">Komoditas</a>
                </li>
                <div class="vertical-line"></div>
                <li>
                    <a href="index.php?route=/statistik"
                        class="nav-link <?= ($current_page == 'statistik') ? 'active' : ''; ?>">Statistik</a>
                </li>
                <div class="vertical-line"></div>
                <li>
                    <a href="index.php?route=/admin" class="nav-link">Panel Admin</a>
                </li>
            </ul>
        </nav>
    </div>
</header>