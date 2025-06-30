<?php

require_once 'configs/connection.php';

$sql = "SELECT market_commodities.id_commodity, commodities.name as commodity_name, commodities.icon, commodities.unit, commodities.image, market_commodities.price, market_commodities.status, market_commodities.percent FROM market_commodities INNER JOIN commodities ON commodities.id = market_commodities.id_commodity INNER JOIN markets ON markets.id = market_commodities.id_market";

$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Komoditas - Informasi Pangan Kota Cimahi</title>
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
        <section class="filter-section animate-fadein">
            <div class="filter-section-container">
                <div class="info-alert">
                    📢 Menampilkan semua informasi harga pangan di kota Cimahi!
                </div>
                <div class="filter-right">
                    <div class="search-container">
                        <i class='bx bx-search search-icon'></i>
                        <input id="cariKomoditas" type="text" class="search-input" placeholder="Cari Komoditas ..." />
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

        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

    <!-- Modal Chart Start -->
    <div class="modal micromodal-slide" id="modal-chart" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
            <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
                <header class="modal__header">
                    <h2 class="modal__title" id="modal-chart-title">
                        Nama Komoditas
                    </h2>
                    <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
                </header>
                <main class="modal__content" id="modal-chart-content">
                    <div id="loading-chart" style="text-align:center; padding:20px; display:none;">
                        <span>Loading... 🔃</span>
                    </div>
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
                        <label for="kecamatan" class="label-filter">Kecamatan</label>
                        <select class="select-kecamatan">
                            <option value="all">Semua Kecamatan</option>
                            <?php $result = $connection->query('SELECT * FROM regions');
                            foreach ($result as $region): ?>
                                <option value="<?= $region['id'] ?>"><?= $region['district'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <label for="pasar" style="display: none;" id="label-pasar" class="label-filter">Pasar</label>
                        <select class="select-pasar" style="display: none;">
                            <option value="all" id="select-pasar-placeholder">Semua Pasar</option>
                        </select>
                        <label for="kondisi-harga" class="label-filter">Kondisi Harga</label>
                        <select class="select-kondisi-harga">
                            <option value="all">Semua Kondisi</option>
                            <option value="Naik">Naik</option>
                            <option value="Turun">Turun</option>
                            <option value="Stabil">Stabil</option>
                        </select>
                    </form>
                </main>
                <footer class="modal__footer">
                    <button class="modal__btn modal__btn-primary" id="submit-filter"
                        data-micromodal-close>Continue</button>
                    <button class="modal__btn" data-micromodal-close
                        aria-label="Close this dialog window">Close</button>
                </footer>
            </div>
        </div>
    </div>
    <!-- Modal Filter End -->

    <script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
    <script src="pages/user/services/FilterService.js"></script>
    <script src="pages/user/services/ChartService.js"></script>
    <script src="pages/user/assets/js/script.js"></script>

    <script>
        let marketId = 'all';
        let kecamatanId = 'all';
        let kondisi = 'all';
        let keyword = 'all';

        const SELECT_KONDISI = document.querySelector(".select-kondisi-harga");
        const SELECT_KECAMATAN = document.querySelector(".select-kecamatan");
        const SELECT_PASAR = document.querySelector(".select-pasar");
        const LABEL_PASAR = document.getElementById('label-pasar');
        SELECT_KECAMATAN.addEventListener("change", e => {
            if (e.target.value !== "all") {
                SELECT_PASAR.style.display = "block";
                LABEL_PASAR.style.display = "block";
            } else if (e.target.value === "all") {
                SELECT_PASAR.style.display = "none";
                LABEL_PASAR.style.display = "none";
                marketId = 'all';
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
            FilterService.FilteredCommodities(marketId, kondisi, kecamatanId, keyword);
        });

        document.querySelector(".filter-komoditas").addEventListener("click", () => {
            MicroModal.show("modal-1", {
                disableScroll: true
            });
        });

        document.querySelectorAll(".card").forEach((el, i) => {
            el.style.animationDelay = `${i * 0.2}s`;
        });

        window.addEventListener('load', function () {
            FilterService.FilteredCommodities(marketId, kondisi, kecamatanId, keyword);
        });

        const searchInput = document.getElementById('cariKomoditas');

        searchInput.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                keyword = searchInput.value.trim();
                if (keyword !== '') {
                    FilterService.FilteredCommodities(marketId, kondisi, kecamatanId, keyword);
                } else if (keyword === '') {
                    keyword = 'all'
                    FilterService.FilteredCommodities(marketId, kondisi, kecamatanId, keyword);
                }
            }
        });
    </script>
</body>

</html>