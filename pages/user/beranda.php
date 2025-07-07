<?php

require_once 'configs/connection.php';

$sql = "SELECT
    c.id AS id_commodity,
    c.name AS commodity_name,
    c.icon,
    c.unit,
    c.image,
    mc.price,
    mc.status,
    mc.percent,
    mc.create_at
FROM
    market_commodities mc
INNER JOIN (
    SELECT
        id_commodity,
        MAX(create_at) AS latest_create_at
    FROM
        market_commodities
    GROUP BY
        id_commodity
) latest_mc
ON
    mc.id_commodity = latest_mc.id_commodity
    AND mc.create_at = latest_mc.latest_create_at
INNER JOIN commodities c ON c.id = mc.id_commodity
INNER JOIN markets m ON m.id = mc.id_market
INNER JOIN regions r ON m.id_region = r.id
";

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
                        <div class="card animate-fadein">
                            <div class="harga">
                                <span>Rp. <?= number_format($data['price'], 0, ',', '.') ?> / <?= $data['unit'] ?></span>
                            </div>
                            <img src="public/images/<?= $data['image'] ?>" class="card-img"
                                alt="<?= $data['commodity_name'] ?>">
                            <div class="view-detail">View Detail</div>
                            <div class="card-body">
                                <h4 class="card-title"><?= $data['icon'] ?>     <?= $data['commodity_name'] ?></h4>
                                <div class="info-grid">
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
                                    <div class="vertical-line" style="height: 30px;"></div>
                                    <span><?= $data['percent'] ?>%</span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <section id="cart-section">
                <h1 style="margin-top : 80px;">Simulasi Belanja - Keranjang</h1>
                <div id="cart">
                        <h2 id="ket-keranjang">Daftar Komoditas</h2>
                        <div class="list-komoditas-container">
                            <?php foreach($result as $data) : ?>
                            <div class="list-komoditas">
                                <h3><?= $data['icon'] ?> - <?= $data['commodity_name'] ?></h3>
                                <p><span>Rp. <?= number_format($data['price'], 0, ',', '.') ?> / <?= $data['unit'] ?></span></p>
                                <p><i class="<?php
                                        if ($data['status'] == 'Naik') {
                                            echo 'bx bx-arrow-up-right-stroke';
                                        } else if ($data['status'] == 'Turun') {
                                            echo 'bx bx-arrow-down-right-stroke';
                                        } else {
                                            echo 'bx bx-stroke-pen';
                                        }
                                        ?>"></i> <span><?= $data['percent'] ?>%</span></p>
                                <button onclick="addToCart('<?= $data['id_commodity'] ?>', '<?= $data['commodity_name'] ?>', '<?= $data['price'] ?>')" class="tampil-btn" style="margin-left: 2px; background-color: #307bc4; color: white;"> + Tambah </button>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="keranjang-container">
                            <h3>Keranjang Belanja</h3>
                            <div class="keranjang" id="cart-items"></div>
                            <p>Total <span id="cart-total">Rp. 0</span></p>
                        </div>
                    </div>
            </section>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script>
        let cart = [];

        function addToCart(id, name, price) {
            const existing = cart.find(item => item.id === id);
            if (existing) {
                existing.qty += 1;
            } else {
                cart.push({ id, name, price, qty: 1 });
            }
            renderCart();
        }

        function renderCart() {
            const container = document.getElementById('cart-items');
            const totalElem = document.getElementById('cart-total');
            container.innerHTML = '';
            let total = 0;

            cart.forEach((item, i) => {
                const subTotal = item.price * item.qty;
                total += subTotal;
                let formatter = new Intl.NumberFormat('id-ID');

                const div = document.createElement('div');
                div.className = "card-items";
                div.innerHTML = `
                <div>
                    <h3 style="margin-bottom: -12px;"><strong>${item.name}</strong> x ${item.qty}</h3>
                    <h4>Rp. ${formatter.format(item.price)}</h4>
                </div>
                <div class="d-flex">
                    <button onclick="updateQty(${i}, -1)" class="tampil-btn">-</button>
                    <button onclick="updateQty(${i}, 1)" class="tampil-btn">+</button>
                    <button onclick="removeItem(${i})" class="tampil-btn">Hapus</button>
                </div>
            `;
                container.appendChild(div);
            });

            totalElem.textContent = "Rp " + total.toLocaleString();
        }

        function updateQty(index, delta) {
            cart[index].qty += delta;
            if (cart[index].qty <= 0) cart.splice(index, 1);
            renderCart();
        }

        function removeItem(index) {
            cart.splice(index, 1);
            renderCart();
        }
    </script>

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