<?php

include '../api.php';

$decode = json_decode($json, true);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Informasi Pangan Kota Cimahi</title>
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'navbar.php'; ?>

        <h1 class="container">Informasi Harga Pangan Terkini</h1>

    <div>
        <img src="https://rsum.bandaacehkota.go.id/wp-content/uploads/2024/05/sayuran.jpg" alt="" class="long-image">
    </div>

    <div class="container">
        <div class="d-flex scroll-x">
            <?php foreach ($decode as $data): ?>
                <div class="card <?= $data['status'] ?>">
                    <div class="harga">
                        <span><?= $data['harga'] ?></span>
                    </div>
                    <img src="<?= $data['foto'] ?>" class="card-img" alt="<?= $data['komoditas'] ?>">
                    <div class="card-body">
                        <h4 class="card-title"><?= $data['komoditas'] ?></h4>
                        <p class="card-text">Harga <?= $data['status'] ?>, <?= $data['selisih'] ?>     <?= $data['persen'] ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- <script>
        window.addEventListener("DOMContentLoaded", async (e) => {
            const res = await fetch("../api.php")
            const data = await res.json();
            const container = document.querySelector(".knyt");
            container.innerHTML = "";
            data.forEach(element => {
                container.innerHTML += `<div class="card naik">
                <div class="harga">
                    <span>Rp. ${element.type_shit}</span>
                </div>
                <img src="https://pekalongankota.go.id/upload/berita/berita_20250110020806.jpeg" class="card-img"
                    alt="Cabai Merah Keriting">
                <div class="card-body">
                    <h4 class="card-title">${element.id}</h4>
                    <p class="card-text">Harga Naik + ${new Date()}</p>
                </div>
            </div>`
            });
        })
    </script> -->

</body>

</html>