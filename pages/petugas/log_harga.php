<?php require_once "configs/connection.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Harga - Petugas</title>
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="pages/petugas/assets/css/style.css">
    <link rel="stylesheet" href="assets/css/micromodal.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
    <?php include "includes/header.php" ?>
    <?php include "includes/sidebar.php" ?>

    <!-- Modal -->

    <div class="modal micromodal-slide" id="modal-log" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1">
            <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
                <header class="modal__header">
                    <h2 class="modal__title" id="modal-log-title">
                        Detail Log
                    </h2>
                    <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
                </header>
                <main class="modal__content" id="modal-log-content">
                    <form class="form-control" id="log-form" method="POST">
                        <div class="group-control">
                            <label for="price_before" class="label-control">Harga - Sebelum :</label>
                            <input type="text" name="price_before" class="input-control" required
                                autocomplete="no">
                            <label for="price_after" class="label-control">Harga - Sesudah :</label>
                            <input type="text" name="price_after" class="input-control" required
                                autocomplete="no">
                            <label for="status_before" class="label-control">Status - Sebelum :</label>
                            <input type="text" name="status_before" class="input-control" required
                                autocomplete="no">
                            
                            <label for="status_after" class="label-control">Status - Sesudah :</label>
                            <input type="text" name="status_after" class="input-control" required
                                autocomplete="no">
                            <label for="percent_before" class="label-control">% - Sebelum :</label>
                            <input type="text" name="percent_before" class="input-control" required
                                autocomplete="no">
                            <label for="percent_after" class="label-control">% - Sesudah :</label>
                            <input type="text" name="percent_after" class="input-control" required
                                autocomplete="no">
                        </div>
                </main>
                <footer class="modal__footer">
                    <button class="modal__btn" data-micromodal-close
                        aria-label="Close this dialog window">Close</button>
                </footer>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal End -->

    <section class="kelola">
        <div class="kelola-aksi">
            <div class="search-container">
                <i class='bx bx-search search-icon'></i>
                <input type="text" class="search-input" onkeydown="onSearch(event)" placeholder="Cari log ... (tap Enter)" />
            </div>
        </div>
        <div class="table-container">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th><input type="checkbox" /></th>
                        <th class="title-table">No</th>
                        <th class="title-table">Waktu</th>
                        <th class="title-table">Komoditas</th>
                        <th class="title-table">Pasar</th>
                        <th class="title-table">Petugas</th>
                        <th class="title-table">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $search = $_GET['search'] ?? "";
                    $user = $_SESSION['id'];
                    $sql = "SELECT price_logs.id, price_logs.create_at as `time`, commodities.name as commodity, CONCAT(markets.name, ' - ', regions.district, ', ', regions.city) as market, price_logs.price_before, price_logs.price_after, price_logs.status_before, price_logs.status_after, price_logs.percent_before, price_logs.percent_after, users.name FROM price_logs INNER JOIN market_commodities ON market_commodities.id = price_logs.id_market_commodity INNER JOIN commodities ON commodities.id = market_commodities.id_commodity INNER JOIN markets ON markets.id = market_commodities.id_market INNER JOIN regions ON markets.id_region = regions.id INNER JOIN users ON users.id = market_commodities.id_user WHERE commodities.name LIKE '%$search%' AND price_logs.id_user = '$user' ORDER BY price_logs.id ASC";
                    $logs = $connection->query($sql);
                    foreach ($logs as $i => $log):
                        ?>
                        <tr>
                            <td><input type="checkbox" /></td>
                            <td><?= $i += 1 ?></td>
                            <td><?= $log["time"] ?? "" ?></td>
                            <td><?= $log["commodity"] ?></td>
                            <td><?= $log["market"] ?></td>
                            <td><?= $log["name"] ?></td>
                            <td>
                                <button class="btn-aksi detail"
                                    onclick="openModal('modal-log'); LogService.GetLogDetail(<?= $log['id'] ?>);" title="Lihat detail log ..."><i
                                        class='bx bx-info-circle'></i></button>
                                <button class="btn-aksi delete"
                                    onclick="LogService.ConfirmAndRemove(event, <?= $log['id'] ?>)"><i
                                        class='bx bx-trash'></i></button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </section>
    <script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="pages/petugas/services/LogService.js"></script>
</body>

</html>