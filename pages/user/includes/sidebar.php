<div class="sidebar-app">
    <div class="sidebar-wrapper">
        <div class="sidebar-container">
            <div class="top-section">
                <img src="assets/img/Logo-Cimahi.PNG" class="main-icon"
                    alt="Main Icon">
                <span class="title">PANGAN CIMAHI</span>
            </div>
            <div class="menu-side-group">
                <a class="menu-side <?= ($current_page == '') ? 'active' : '' ?>" href="index.php">
                    <span><span class="side-icon">🏠</span> Beranda</span>
                </a>
                <a class="menu-side <?= ($current_page == 'komoditas') ? 'active' : '' ?>" href="index.php?route=/komoditas">
                    <span><span class="side-icon">🥩</span> Komoditas</span>
                </a>
                <a class="menu-side <?= ($current_page == 'statistik') ? 'active' : '' ?>" href="index.php?route=/statistik">
                    <span><span class="side-icon">📈</span> Statistik</span>
                </a>
                <a class="menu-side <?= ($current_page == 'admin') ? 'active' : '' ?>" href="index.php?route=/admin">
                    <span><span class="side-icon">📌</span> Kelola Harga</span>
                </a>
                <a class="menu-side close" id="close-sidebar">
                    <span><span class="side-icon">❌</span> Close Sidebar</span>
                </a>
            </div>
        </div>
    </div>
</div>