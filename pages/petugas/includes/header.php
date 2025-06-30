<?php
$current_page = trim($_GET['route'] ?? "", "/");
?>
<header class="app-navbar">
    <div class="app-bar-container">
        <div class="left-section">
            <img src="https://upload.wikimedia.org/wikipedia/commons/f/f6/Logo-Cimahi.png" class="main-icon"
                alt="Main Icon">
            <span class="title">PETUGAS PANEL</span>
        </div>
        <div class="right-section">
            <div class="group-menu-nav">
                <a class="menu-nav <?= ($current_page == 'petugas') ? 'active' : '' ?>" href="index.php?route=/petugas">
                    <span>🏠 Beranda</span>
                </a>
                <a class="menu-nav <?= ($current_page == 'petugas/kelola-harga') ? 'active' : '' ?>"
                    href="index.php?route=/petugas/kelola-harga">
                    <span>💰 Kelola Harga</span>
                </a>
                <a class="menu-nav <?= ($current_page == 'petugas/log-harga') ? 'active' : '' ?>"
                    href="index.php?route=/petugas/log-harga">
                    <span>⌛ Log Harga</span>
                </a>
                <form action="pages/auth/actions/logout.php" onsubmit="return confirm('Yakin logout?')">
                    <button class="logout">
                        <span>Log Out</span>
                    </button>
                </form>
            </div>
        </div>
        <button class="menu-mobile">
            <i class='bx bx-menu-right icon'></i>
        </button>
    </div>
</header>