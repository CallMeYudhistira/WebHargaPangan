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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="pages/user/assets/css/micromodal.css" rel="stylesheet">
    <link rel="stylesheet" href="pages/user/assets/css/style.css">
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
            <div class="card" onclick="chartModal()" style="margin: 5px;">
                <div class="harga">
                    <span><?= $data['harga'] ?> / KG</span>
                </div>
                <img src="<?= $data['foto'] ?>" class="card-img" alt="<?= $data['komoditas'] ?>">
                <div class="view-detail">View Detail</div>
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
                        <select class="select-pasar">
                            <option>Pilih Pasar</option>
                            <option>Pasar Baros</option>
                            <option>Pasar Atas</option>
                        </select>
                        <select class="select-kondisi-harga">
                            <option>Pilih Kondisi Harga</option>
                            <option>Naik</option>
                            <option>Turun</option>
                            <option>Stabil</option>
                        </select>
                    </form>
                </main>
                <footer class="modal__footer">
                    <button class="modal__btn modal__btn-primary" data-micromodal-close>Continue</button>
                    <button class="modal__btn" data-micromodal-close
                        aria-label="Close this dialog window">Close</button>
                </footer>
            </div>
        </div>
    </div>
    <!-- Modal Filter End -->

    <script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
    <script>
        document.querySelector(".filter-komoditas").addEventListener("click", () => {
            MicroModal.show("modal-1", {
                disableScroll: true
            });
        });

        document.querySelectorAll(".card").forEach((el, i) => {
            el.style.animationDelay = `${i * 0.2}s`;
        });

        const SELECT_PASAR = document.querySelector(".select-pasar");

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