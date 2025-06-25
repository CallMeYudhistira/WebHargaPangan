<?php

require_once 'api.php';

$data = json_decode($json, true);

$now = date('Y-m');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik - Informasi Pangan Kota Cimahi</title>
    <link href="pages/user/assets/css/style.css" rel="stylesheet">
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php include 'includes/navbar.php' ?>

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
                        <option value="" data-pasar="Semua Pasar">Semua Pasar</option>
                        <option value="" data-pasar="Pasar Atas">Pasar Atas</option>
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
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($data as $a):
                            ?>
                            <tr>
                                <td><input type="checkbox" /></td>
                                <td><?= $i ?></td>
                                <td style="font-size: 17px"><img src="<?= $a['foto'] ?>" alt="<?= $a['komoditas'] ?>"
                                        style="width: 200px; border-radius: 12px;"></td>
                                <td><?= $a['komoditas'] ?></td>
                                <td><?= $a['harga'] ?> / KG</td>
                                <td><?= $a['tinggi'] ?> / KG</td>
                                <td><?= $a['rendah'] ?> / KG</td>
                            </tr>
                            <?php $i++; endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

</body>

</html>