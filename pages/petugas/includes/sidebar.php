<div class="sidebar-app">
    <div class="sidebar-wrapper">
        <div class="sidebar-container">
            <div class="top-section">
                <img src="https://upload.wikimedia.org/wikipedia/commons/f/f6/Logo-Cimahi.png" class="main-icon"
                    alt="Main Icon">
                <span class="title">PANGAN CIMAHI</span>
            </div>
            <div class="menu-side-group">
                <a class="menu-side <?= ($current_page == 'petugas') ? 'active' : '' ?>" href="index.php?route=/petugas">
                    <span><span class="side-icon">🏠</span> Beranda</span>
                </a>
                <a class="menu-side <?= ($current_page == 'petugas/kelola-harga') ? 'active' : '' ?>" href="index.php?route=/petugas/kelola-harga">
                    <span><span class="side-icon">💰</span> Kelola Harga</span>
                </a>
                <a class="menu-side <?= ($current_page == 'petugas/log-harga') ? 'active' : '' ?>" href="index.php?route=/petugas/log-harga">
                    <span><span class="side-icon">⌛</span> Log Harga</span>
                </a>
                <a class="menu-side out" href="pages/auth/actions/logout.php">
                    <span><span class="side-icon">↪</span> Log Out</span>
                </a>
                <a class="menu-side close" id="close-sidebar" onclick="return confirm('Yakin logout?')">
                    <span><span class="side-icon">❌</span> Close Sidebar</span>
                </a>
            </div>
        </div>
    </div>
</div>