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
    <title>Komoditas - Informasi Pangan Kota Cimahi</title>
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="pages/user/assets/css/micromodal.css" rel="stylesheet">
    <link rel="stylesheet" href="pages/user/assets/css/style.css">
</head>

<body>
    <?php include 'includes/navbar.php' ?>

    <section class="filter-section animate-fadein">
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

    <div class="komoditas-grid" id="komoditas-grid">
        <?php foreach ($result as $data): ?>
            <div>
                <div class="card animate-fadein" onclick="chartModal()" style="margin: 0; margin-top: 12px;">
                    <div class="harga">
                        <span>Rp. <?= $data['price'] ?> / <?= $data['unit'] ?></span>
                    </div>
                    <img src="public/images/<?= $data['image'] ?>" class="card-img" alt="<?= $data['commodity_name'] ?>">
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
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Modal Chart Start -->
    <div class="modal micromodal-slide" id="modal-chart" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
            <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
                <header class="modal__header">
                    <h2 class="modal__title" id="modal-chart-title">
                        Analisis Harga Bawang Merah
                    </h2>
                    <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
                </header>
                <main class="modal__content" id="modal-chart-content">
                    <canvas id="hargaChart"></canvas>
                </main>
                <footer class="modal__footer">
                    <button class="modal__btn" data-micromodal-close
                        aria-label="Close this dialog window">Close</button>
                </footer>
            </div>
        </div>
    </div>
    <!-- Modal Chart End -->

    <!-- Modal Filter Start -->
    <div class="modal micromodal-slide" id="modal-1" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
            <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
                <header class="modal__header">
                    <h2 class="modal__title" id="modal-1-title">
                        Filter
                    </h2>
                    <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
                </header>
                <main class="modal__content" id="modal-1-content">
                    <form class="form-filter">
                        <select class="select-kecamatan">
                            <option value="all" selected disabled>Pilih Kecamatan</option>
                            <?php $result = $connection->query('SELECT * FROM regions');
                            foreach ($result as $region): ?>
                                <option value="<?= $region['id'] ?>"><?= $region['district'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <select class="select-pasar" style="display: none;">
                            <option value="all" selected disabled id="select-pasar-placeholder">Pilih Pasar</option>
                        </select>
                        <select class="select-kondisi-harga">
                            <option value="all">Pilih Kondisi Harga</option>
                            <option value="Naik">Naik</option>
                            <option value="Turun">Turun</option>
                            <option value="Stabil">Stabil</option>
                        </select>
                    </form>
                </main>
                <footer class="modal__footer">
                    <button class="modal__btn modal__btn-primary" id="submit-filter">Continue</button>
                    <button class="modal__btn" data-micromodal-close
                        aria-label="Close this dialog window">Close</button>
                </footer>
            </div>
        </div>
    </div>
    <!-- Modal Filter End -->

    <?php include 'includes/footer.php'; ?>

    <script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
    <script src="pages/user/services/FilterService.js"></script>
    <script>
        let marketId = 'all';
        let kecamatanId = 'all';
        let kondisi = 'all';

        const SELECT_KONDISI = document.querySelector(".select-kondisi-harga");
        const SELECT_KECAMATAN = document.querySelector(".select-kecamatan");
        const SELECT_PASAR = document.querySelector(".select-pasar");
        SELECT_KECAMATAN.addEventListener("change", e => {
            if (e.target.value !== "") {
                SELECT_PASAR.style.display = "block";
            }
        });

        SELECT_KECAMATAN.addEventListener('change', function () {
            kecamatanId = SELECT_KECAMATAN.value;
            FilterService.GetMarkets(kecamatanId);
        });

        SELECT_KONDISI.addEventListener('change', function () {
            kondisi = SELECT_KONDISI.value;
        });

        SELECT_PASAR.addEventListener('change', function () {
            marketId = SELECT_PASAR.value;
        });

        const BUTTON_FILTER = document.getElementById("submit-filter");

        BUTTON_FILTER.addEventListener('click', function () {
            FilterService.FilteredCommodities(marketId, kondisi, kecamatanId);
        });

        document.querySelector(".filter-komoditas").addEventListener("click", () => {
            MicroModal.show("modal-1", {
                disableScroll: true
            });
        });

        const INPUT_SEARCH = document.query

        document.querySelectorAll(".card").forEach((el, i) => {
            el.style.animationDelay = `${i * 0.2}s`;
        });

        const chartModal = () => {
            MicroModal.show("modal-chart", {
                disableScroll: true,
                disableFocus: true
            });

            const ctx = document.getElementById('hargaChart').getContext('2d');

            const tanggal = ['17 Jun 2025', '18 Jun 2025', '19 Jun 2025', '20 Jun 2025', '21 Jun 2025', '22 Jun 2025', '23 Jun 2025'];
            const harga = [10000, 10200, 9800, 10100, 9900, 10500, 10300];

            const gradient = ctx.createLinearGradient(0, 0, 0, 200);
            gradient.addColorStop(0, 'rgba(0, 200, 83, 0.2)');
            gradient.addColorStop(1, 'rgba(0, 200, 83, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: tanggal,
                    datasets: [{
                        label: 'Harga',
                        data: harga,
                        fill: true,
                        backgroundColor: gradient,
                        borderColor: '#00c853',
                        tension: 0.4,
                        borderWidth: 2,
                        pointRadius: 0,
                        pointHoverRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            titleFont: {
                                family: 'Poppins',
                                size: 13,
                                weight: '500'
                            },
                            bodyFont: {
                                family: 'Poppins',
                                size: 12,
                                weight: '400'
                            },
                            callbacks: {
                                label: function (context) {
                                    const value = context.parsed.y;
                                    return 'Harga: Rp ' + value.toLocaleString();
                                }
                            }
                        }
                    },
                    interaction: {
                        mode: 'index',
                        intersect: false
                    },
                    scales: {
                        x: { display: false },
                        y: { display: false }
                    }
                }
            });
        }
    </script>
</body>

</html>