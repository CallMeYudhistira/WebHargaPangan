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
            </div>
        </div>
    </div>
</header>