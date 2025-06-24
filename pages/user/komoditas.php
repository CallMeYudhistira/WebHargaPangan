<?php

include 'api.php';

$decode = json_decode($json, true);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komoditas - Informasi Pangan Kota Cimahi</title>
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link href="pages/user/assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'includes/navbar.php' ?>

    <section class="filter-section">
        <div class="filter-section-container">
            <div class="info-alert">
                📢 Menampilkan semua informasi harga pangan di kota Cimahi!
            </div>
            <div class="filter-right">
                <div class="search-container">
                    <i class='bx bx-search search-icon'></i>
                    <input type="text" class="search-input" placeholder="Cari Komoditas ..." />
                </div>
                <button class="dropdown-btn filter-komoditas">
                    <span class="chevron">
                        <i class='bx bx-menu-filter'></i>
                    </span>
                    Filter
                </button>
            </div>
        </div>
    </section>

    <div class="komoditas-grid">
        <?php foreach ($decode as $data): ?>
            <div class="card">
                <div class="harga">
                    <span><?= $data['harga'] ?> / KG</span>
                </div>
                <img src="<?= $data['foto'] ?>" class="card-img" alt="<?= $data['komoditas'] ?>">
                <div class="card-body">
                    <h4 class="card-title"><?= $data['komoditas'] ?></h4>
                    <div class="status <?= $data['status'] ?>">
                        <i class="<?php
                        if ($data['status'] == 'naik') {
                            echo 'bx bx-arrow-up-right-stroke';
                        } else if ($data['status'] == 'turun') {
                            echo 'bx bx-arrow-down-right-stroke';
                        } else {
                            echo 'bx bx-stroke-pen';
                        }
                        ?>"></i> <span class="card-text"><?= $data['status'] ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>