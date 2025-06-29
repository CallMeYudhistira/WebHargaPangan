<?php
$current_page = trim($_GET['route'] ?? "", "/");
?>
<header class="app-navbar">
    <div class="app-bar-container">
        <div class="left-section">
            <img src="https://upload.wikimedia.org/wikipedia/commons/f/f6/Logo-Cimahi.png" class="main-icon"
                alt="Main Icon">
            <span class="title">ADMIN PANEL</span>
        </div>
        <div class="right-section">
            <div class="group-menu-nav">
                <a class="menu-nav <?= ($current_page == 'admin') ? 'active' : '' ?>" href="index.php?route=/admin">
                    <span>🏠 Beranda</span>
                </a>
                <a class="menu-nav <?= ($current_page == 'admin/kelola-komoditas') ? 'active' : '' ?>" href="index.php?route=/admin/kelola-komoditas">
                    <span>🥩 Kelola Komoditas</span>
                </a>
                <a class="menu-nav <?= ($current_page == 'admin/kelola-pasar') ? 'active' : '' ?>" href="index.php?route=/admin/kelola-pasar">
                    <span>📌 Kelola Pasar</span>
                </a>
                <a class="menu-nav <?= ($current_page == 'admin/kelola-harga') ? 'active' : '' ?>" href="index.php?route=/admin/kelola-harga">
                    <span>💰 Kelola Harga</span>
                </a>
                <a class="menu-nav <?= ($current_page == 'admin/log-harga') ? 'active' : '' ?>" href="index.php?route=/admin/log-harga">
                    <span>⌛ Log Harga</span>
                </a>
            </div>
        </div>
        <button class="menu-mobile">
            <i class='bx bx-menu-right icon'></i> 
        </button>
    </div>
</header>