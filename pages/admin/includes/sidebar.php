<div class="sidebar-app">
    <div class="sidebar-wrapper">
        <div class="sidebar-container">
            <div class="top-section">
                <img src="https://upload.wikimedia.org/wikipedia/commons/f/f6/Logo-Cimahi.png" class="main-icon"
                    alt="Main Icon">
                <span class="title">PANGAN CIMAHI</span>
            </div>
            <div class="menu-side-group">
                <a class="menu-side <?= ($current_page == 'admin') ? 'active' : '' ?>" href="index.php?route=/admin">
                    <span><span class="side-icon">🏠</span> Beranda</span>
                </a>
                <a class="menu-side <?= ($current_page == 'admin/kelola-komoditas') ? 'active' : '' ?>" href="index.php?route=/admin/kelola-komoditas">
                    <span><span class="side-icon">🥩</span> Kelola Komoditas</span>
                </a>
                <a class="menu-side <?= ($current_page == 'admin/kelola-pasar') ? 'active' : '' ?>" href="index.php?route=/admin/kelola-pasar">
                    <span><span class="side-icon">📌</span> Kelola Pasar</span>
                </a>
                <a class="menu-side <?= ($current_page == 'admin/kelola-harga') ? 'active' : '' ?>" href="index.php?route=/admin/kelola-harga">
                    <span><span class="side-icon">📌</span> Kelola Harga</span>
                </a>
                <a class="menu-side <?= ($current_page == 'admin/log-harga') ? 'active' : '' ?>" href="index.php?route=/admin/log-harga">
                    <span><span class="side-icon">⌛</span> Log Harga</span>
                </a>
                <a class="menu-side close" id="close-sidebar">
                    <span><span class="side-icon">❌</span> Close Sidebar</span>
                </a>
            </div>
        </div>
    </div>
</div>