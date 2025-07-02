<?php

require_once 'configs/connection.php';

$sql = "SELECT MAX(commodities.id) as id_commodity, MAX(commodities.name) as commodity_name, MAX(commodities.icon) as icon, MAX(commodities.unit) as unit, MAX(commodities.image) as image, MAX(market_commodities.price) as price, MAX(market_commodities.status) as status, MAX(market_commodities.percent) as percent FROM market_commodities INNER JOIN commodities ON commodities.id = market_commodities.id_commodity INNER JOIN markets ON markets.id = market_commodities.id_market GROUP BY commodities.id";

$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard - Informasi Pangan Kota Cimahi</title>
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
            <h1 style="font-size: 38px;">Informasi Harga Pangan Terkini</h1>

            <div class="slider">
                <div class="slides">
                    <img src="https://cdn.pixabay.com/photo/2022/01/18/16/30/vegetables-6947442_1280.jpg"
                        class="slide active" />
                    <img src="https://cdn.pixabay.com/photo/2015/04/27/15/01/vegetables-742095_1280.jpg"
                        class="slide" />
                    <img src="https://cdn.pixabay.com/photo/2015/05/04/10/16/vegetables-752153_1280.jpg"
                        class="slide" />
                    <img src="https://cdn.pixabay.com/photo/2018/06/30/15/33/vegetables-3507843_1280.jpg"
                        class="slide" />
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
                            <img src="public/images/<?= $data['image'] ?>" class="card-img"
                                alt="<?= $data['commodity_name'] ?>">
                            <div class="card-body">
                                <h4 class="card-title"><?= $data['icon'] ?>     <?= $data['commodity_name'] ?></h4>
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

            <!-- <h1 style="margin-top: 80px;">Simulasi Belanja - Keranjang</h1>

            <div class="keranjang-container">
                <div class="list-komoditas">
                    <h2>Ini List Barang</h2>
                </div>
                <div class="keranjang">
                    <h2>Ini Isi Keranjang</h2>
                </div>
            </div> -->
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
    <script src="pages/user/services/FilterService.js"></script>
    <script src="pages/user/services/ChartService.js"></script>
    <script src="pages/user/assets/js/script.js"></script>

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