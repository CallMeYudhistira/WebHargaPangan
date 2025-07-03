<?php

$current_page = trim($_GET['route'] ?? "", "/");

?>
<header class="app-navbar">
    <div class="app-bar-container">
        <div class="left-section">
            <img src="assets/img/Logo-Cimahi.PNG" class="main-icon"
                alt="Main Icon">
            <span class="title">INFO PANGAN KOTA CIMAHI</span>
        </div>
        <div class="right-section">
            <div class="group-menu-nav">
                <a class="menu-nav <?= ($current_page == '') ? 'active' : '' ?>" href="index.php">
                    <span>🏠 Beranda</span>
                </a>
                <a class="menu-nav <?= ($current_page == 'komoditas') ? 'active' : '' ?>" href="index.php?route=/komoditas">
                    <span>🥩 Komoditas</span>
                </a>
                <a class="menu-nav <?= ($current_page == 'statistik') ? 'active' : '' ?>" href="index.php?route=/statistik">
                    <span>📈 Statistik</span>
                </a>
                <!-- <a class="menu-nav <?= ($current_page == 'admin') ? 'active' : '' ?>" href="index.php?route=/admin">
                    <span>Panel Admin</span>
                </a> -->
            </div>
        <button class="menu-mobile">
            <i class='bx bx-menu-right icon'></i> 
        </button>
        </div>
    </div>
</header>