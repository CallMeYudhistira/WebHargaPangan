<?php

$now = date('Y-m');

require_once 'configs/connection.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Statistik - Informasi Pangan Kota Cimahi</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="pages/user/assets/css/micromodal.css" rel="stylesheet">
    <link href="pages/user/assets/css/navbar.css" rel="stylesheet">
    <link href="pages/user/assets/css/sidebar.css" rel="stylesheet">
    <link rel="stylesheet" href="pages/user/assets/css/style.css">
</head>

<body>
    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/sidebar.php'; ?>
    <main>
        <div class="container animate-fadein">
            <h1>Tabel Harga Pangan</h1>

            <div class="form-tampil">
                <div class="d-flex" style="justify-content: space-between;">
                    <div class="filter-bulan">
                        <label>Pilih Bulan :</label>
                        <input type="month" id="bulan" name="bulan" value="<?= $now ?>">
                        <button class="tampil-btn">Tampilkan</button>
                    </div>

                    <div class="dropdown-btn pasar-filter">
                        <span class="chevron">
                            <i class='bx bx-menu-filter'></i>
                        </span>
                        <select class="select-pasar-filter">
                            <option value="all">Semua Pasar</option>
                            <?php $result = $connection->query('SELECT * FROM markets');
                            foreach ($result as $market): ?>
                                <option value="<?= $market['id'] ?>"><?= $market['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p class="pasar-filter-text">Semua Pasar</p>
                    </div>
                </div>

                <div class="table-container">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" /></th>
                                <th class="title-table">No</th>
                                <th class="title-table">Foto</th>
                                <th class="title-table">Nama Komoditas</th>
                                <th class="title-table">Harga Rata-Rata</th>
                                <th class="title-table">Harga Tertinggi</th>
                                <th class="title-table">Harga Terendah</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
    <script src="pages/user/services/FilterService.js"></script>
    <script src="pages/user/services/ChartService.js"></script>
    <script src="pages/user/assets/js/script.js"></script>

    <script>
        let marketId = 'all';
        const filter_text = document.querySelector('.pasar-filter-text');
        const select_filter = document.querySelector('.select-pasar-filter');

        select_filter.addEventListener('change', function () {
            const selectedText = this.options[this.selectedIndex].text;
            filter_text.textContent = selectedText;
            marketId = this.value;
            FilterService.GetStats(inp_bulan.value, marketId);
        });

        const tampil_btn = document.querySelector('.tampil-btn');
        const inp_bulan = document.getElementById('bulan');

        tampil_btn.addEventListener('click', function () {
            FilterService.GetStats(inp_bulan.value, marketId);
        });

        window.addEventListener('load', function () {
            FilterService.GetStats(inp_bulan.value, marketId);
        });
    </script>

</body>

</html>