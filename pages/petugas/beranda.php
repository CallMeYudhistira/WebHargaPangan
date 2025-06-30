<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Petugas</title>
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="pages/petugas/assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
    <?php include "includes/header.php" ?>
    <?php include "includes/sidebar.php" ?>

    <div class="kelola">
        <header class="beranda-header">
            Selamat Datang di Panel Petugas
        </header>

        <div class="beranda-container">
            <div class="card">
                <p>Halo,</p>
                <p class="username"><?= $_SESSION['name'] ?></p>
                <p class="subtitle">Semoga harimu menyenangkan di Kota Cimahi 🌿</p>
            </div>
        </div>

        <footer class="beranda-footer">
            © 2025 CIMAHI. All rights reserved.
        </footer>
    </div>

    <script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>