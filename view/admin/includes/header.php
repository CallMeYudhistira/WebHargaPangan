<?php
$current_page = basename($_SERVER['PHP_SELF']);
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
                <a class="menu-nav <?= ($current_page == 'index.php') ? 'active' : '' ?>" href="index.php">
                    <span>🏠 Beranda</span>
                </a>
                <a class="menu-nav <?= ($current_page == 'kelola_komoditas.php') ? 'active' : '' ?>" href="kelola_komoditas.php">
                    <span>🥩 Kelola Komoditas</span>
                </a>
            </div>
        </div>
    </div>
</header>