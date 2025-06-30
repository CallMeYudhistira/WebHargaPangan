<?php require_once "configs/connection.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pasar - Admin</title>
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

    <div class="modal micromodal-slide" id="modal-pasar" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1">
            <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
                <header class="modal__header">
                    <h2 class="modal__title" id="modal-pasar-title">
                        Tambah Pasar
                    </h2>
                    <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
                </header>
                <main class="modal__content" id="modal-pasar-content">
                    <form class="form-control" id="market-form" method="POST">
                        <div class="group-control">
                            <label for="name" class="label-control">Nama Pasar :</label>
                            <input type="text" name="name" placeholder="Nama Pasar" class="input-control" required
                                autocomplete="no">
                        </div>
                        <div class="group-control">
                            <label for="region" class="label-control">Wilayah :</label>
                            <select name="region" class="input-control select-control">
                                <option id="select-region-placeholder" value="" selected disabled>Pilih Wilayah</option>
                                <?php
                                $regions = $connection->query("SELECT * FROM regions");
                                foreach ($regions as $region):
                                    ?>
                                    <option value="<?= $region["id"] ?>">Kecamatan <?= $region["district"] ?> - Kota
                                        <?= $region["city"] ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
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
                <input type="text" class="search-input" onkeydown="onSearch(event)" placeholder="Cari pasar ... (tap Enter)" />
            </div>
            <button class="tambah" onclick="openModal('modal-pasar'); MarketService.HandleNew();">
                <span>Tambah Pasar</span>
            </button>
        </div>
        <div class="table-container">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th><input type="checkbox" /></th>
                        <th class="title-table">No</th>
                        <th class="title-table">Nama Pasar</th>
                        <th class="title-table">Kecamatan</th>
                        <th class="title-table">Kota</th>
                        <th class="title-table">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $search = $_GET['search'] ?? "";
                    $markets = $connection->query("SELECT markets.id, markets.name, regions.district, regions.city FROM markets INNER JOIN regions ON markets.id_region = regions.id WHERE markets.name LIKE '%$search%'");
                    foreach ($markets as $i => $market):
                        ?>
                        <tr>
                            <td><input type="checkbox" /></td>
                            <td><?= $i += 1 ?></td>
                            <td><?= $market["name"] ?></td>
                            <td><?= $market["district"] ?></td>
                            <td><?= $market["city"] ?></td>
                            <td>
                                <button class="btn-aksi edit"
                                    onclick="openModal('modal-pasar'); MarketService.HandleEdit(<?= $market['id'] ?>);"><i
                                        class='bx bx-edit'></i></button>
                                <button class="btn-aksi delete"
                                    onclick="MarketService.ConfirmAndDelete(event, <?= $market['id'] ?>)"><i
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
    <script src="pages/admin/services/MarketService.js"></script>
    <script>
        document.getElementById("market-form").addEventListener("submit", e => {
            e.preventDefault();
            MarketService.InsertOrUpdateMarket();
        })
    </script>
</body>

</html>