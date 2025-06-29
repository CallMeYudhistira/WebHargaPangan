<?php require_once "configs/connection.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Kelola Harga</title>
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="pages/admin/assets/css/style.css">
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

    <div class="modal micromodal-slide" id="modal-harga" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1">
            <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
                <header class="modal__header">
                    <h2 class="modal__title" id="modal-harga-title">
                        Tambah Harga
                    </h2>
                    <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
                </header>
                <main class="modal__content" id="modal-harga-content">
                    <form class="form-control" id="price-form" method="POST">
                        <div class="group-control">
                            <label for="commodity" class="label-control">Komoditas :</label>
                            <select name="commodity" class="input-control select-control" required>
                                <option id="select-commodity-placeholder" value="" selected disabled>Pilih Komoditas</option>
                                <?php
                                $commodities = $connection->query("SELECT * FROM commodities");
                                foreach ($commodities as $commodity):
                                    ?>
                                    <option value="<?= $commodity["id"] ?>"><?= $commodity["name"] ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="group-control">
                            <label for="market" class="label-control">Pasar :</label>
                            <select name="market" class="input-control select-control" required>
                                <option id="select-market-placeholder" value="" selected disabled>Pilih Pasar</option>
                                <?php
                                $markets = $connection->query("SELECT markets.id, markets.name, regions.city, regions.district FROM markets INNER JOIN regions ON markets.id_region = regions.id");
                                foreach ($markets as $market):
                                    ?>
                                    <option value="<?= $market["id"] ?>">Pasar <?= $market["name"] ?>  - Kecamatan <?= $market["district"] ?> - Kota
                                        <?= $market["city"] ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="group-control">
                            <label for="price" class="label-control">Harga :</label>
                            <input type="text" name="price" placeholder="Harga (contoh: 4500)" class="input-control" required
                                autocomplete="no">
                        </div>
                </main>
                <footer class="modal__footer">
                    <button class="modal__btn modal__btn-primary" type="submit">Submit</button>
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
                <input type="text" class="search-input" placeholder="Cari ..." />
            </div>
            <button class="tambah" onclick="openModal('modal-harga'); PriceService.HandleNew();">
                <span>Tambah Harga</span>
            </button>
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
                        <th class="title-table">Harga (Rp)</th>
                        <th class="title-table">Status</th>
                        <th class="title-table">%</th>
                        <th class="title-table">Petugas</th>
                        <th class="title-table">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT market_commodities.id, market_commodities.create_at as `time`, commodities.name as commodity, CONCAT(markets.name, ' - ', regions.district, ', ', regions.city) as market, market_commodities.price, market_commodities.status, market_commodities.percent, users.name FROM market_commodities INNER JOIN commodities ON commodities.id = market_commodities.id_commodity INNER JOIN markets ON markets.id = market_commodities.id_market INNER JOIN regions ON markets.id_region = regions.id INNER JOIN users ON users.id = market_commodities.id_user ORDER BY commodities.id ASC";
                    $prices = $connection->query($sql);
                    foreach ($prices as $i => $price):
                        ?>
                        <tr>
                            <td><input type="checkbox" /></td>
                            <td><?= $i += 1 ?></td>
                            <td><?= $price["time"] ?? "" ?></td>
                            <td><?= $price["commodity"] ?></td>
                            <td><?= $price["market"] ?></td>
                            <td><?= $price["price"] ?></td>
                            <td><?= $price["status"] ?></td>
                            <td><?= $price["percent"] ?></td>
                            <td><?= $price["name"] ?></td>
                            <td>
                                <button class="btn-aksi edit"
                                    onclick="openModal('modal-harga'); PriceService.HandleEdit(<?= $price['id'] ?>);"><i
                                        class='bx bx-edit'></i></button>
                                <button class="btn-aksi delete"
                                    onclick="PriceService.ConfirmAndDelete(event, <?= $price['id'] ?>)"><i
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
    <script src="pages/admin/services/PriceService.js"></script>
    <script>
        document.getElementById("price-form").addEventListener("submit", e => {
            e.preventDefault();
            PriceService.InsertOrUpdatePrice();
        })
    </script>
</body>

</html>