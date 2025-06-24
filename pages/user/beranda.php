<?php

include 'api.php';

$decode = json_decode($json, true);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Informasi Pangan Kota Cimahi</title>
    <link href="pages/user/assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'includes/navbar.php'; ?>

    <h1 class="container">Informasi Harga Pangan Terkini</h1>

    <div class="slider">
        <div class="slides">
            <img src="https://cdn.pixabay.com/photo/2022/01/18/16/30/vegetables-6947442_1280.jpg"
                class="slide active" />
            <img src="https://cdn.pixabay.com/photo/2015/04/27/15/01/vegetables-742095_1280.jpg" class="slide" />
            <img src="https://cdn.pixabay.com/photo/2015/05/04/10/16/vegetables-752153_1280.jpg" class="slide" />
            <img src="https://cdn.pixabay.com/photo/2018/06/30/15/33/vegetables-3507843_1280.jpg" class="slide" />
        </div>
    </div>

    <script src="script.js"></script>

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

    </script>

</body>

</html>