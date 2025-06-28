<?php

require_once 'configs/connection.php';

$sql = "SELECT market_commodities.id_commodity, commodities.name as commodity_name, commodities.icon, commodities.unit, commodities.image, market_commodities.price, market_commodities.status, market_commodities.percent FROM market_commodities INNER JOIN commodities ON commodities.id = market_commodities.id_commodity INNER JOIN markets ON markets.id = market_commodities.id_market";

$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Informasi Pangan Kota Cimahi</title>
    <link href="pages/user/assets/css/style.css" rel="stylesheet">
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="container animate-fadein">
        <h1 style="font-size: 38px;">Informasi Harga Pangan Terkini</h1>

        <div class="slider">
            <div class="slides">
                <img src="https://cdn.pixabay.com/photo/2022/01/18/16/30/vegetables-6947442_1280.jpg"
                    class="slide active" />
                <img src="https://cdn.pixabay.com/photo/2015/04/27/15/01/vegetables-742095_1280.jpg" class="slide" />
                <img src="https://cdn.pixabay.com/photo/2015/05/04/10/16/vegetables-752153_1280.jpg" class="slide" />
                <img src="https://cdn.pixabay.com/photo/2018/06/30/15/33/vegetables-3507843_1280.jpg" class="slide" />
            </div>
        </div>

        <div><br></div>

        <div class="info-terbaru-komoditas">
            <h1 style="text-align: center;">Berikut Harga Pangan Terbaru</h1>
            <div class="d-flex x-scroll" style="padding: 15px;">
                <?php foreach ($result as $data): ?>
                    <div class="card animate-fadein" <?= ($data['status'] == 'stabil') ? 'style="display: none;"' : '' ?>>
                        <div class="harga">
                            <span>Rp. <?= $data['price'] ?> / <?= $data['unit'] ?></span>
                        </div>
                        <img src="public/images/<?= $data['image'] ?>" class="card-img" alt="<?= $data['commodity_name'] ?>">
                        <div class="card-body">
                            <h4 class="card-title"><?= $data['icon'] ?> <?= $data['commodity_name'] ?></h4>
                            <div class="status <?= $data['status'] ?>">
                                <i class="<?php
                                if ($data['status'] == 'Naik') {
                                    echo 'bx bx-arrow-up-right-stroke';
                                } else if ($data['status'] == 'Turun') {
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
        </div>

        <h1 style="margin-top: 80px;">Simulasi Belanja - Keranjang</h1>

        <div class="keranjang-container">
            <div class="list-komoditas">
                <h2>Ini List Barang</h2>
            </div>
            <div class="keranjang">
                <h2>Ini Isi Keranjang</h2>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script>
        let currentSlide = 0;
        const slides = document.querySelector(".slides");
        const totalSlides = document.querySelectorAll(".slide").length;

        function updateSlidePosition() {
            slides.style.transform = `translateX(-${currentSlide * 100}%)`;
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateSlidePosition();
        }

        setInterval(() => {
            nextSlide();
        }, 4000);

        document.querySelectorAll(".card").forEach((el, i) => {
            el.style.animationDelay = `${i * 0.2}s`;
        });
    </script>

</body>

</html>