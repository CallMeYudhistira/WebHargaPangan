<?php require_once "configs/connection.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Kelola Komoditas</title>
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

    <!-- Modal -->

    <div class="modal micromodal-slide" id="modal-komoditas" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1">
            <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
                <header class="modal__header">
                    <h2 class="modal__title" id="modal-komoditas-title">
                        Tambah Komoditas
                    </h2>
                    <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
                </header>
                <main class="modal__content" id="modal-komoditas-content">
                    <form class="form-control" method="POST" onsubmit="CommodityService.InsertOrUpdateCommodity(event)">
                        <div class="group-control">
                            <label for="name" class="label-control">Name :</label>
                            <input type="text" name="name" placeholder="Nama Komoditas" class="input-control" required
                                autocomplete="no">
                        </div>
                        <div class="group-control">
                            <label for="icon" class="label-control">Icon :</label>
                            <input type="text" name="icon" placeholder="Icon (contoh: 🌶️)" class="input-control"
                                required autocomplete="no">
                        </div>
                        <div class="group-control">
                            <label for="unit" class="label-control">Unit :</label>
                            <input type="text" name="unit" placeholder="Satuan (contoh: KG)" class="input-control"
                                required autocomplete="no">
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

    <section class="kelola-komoditas">
        <div class="kelola-aksi">
            <div class="search-container">
                <i class='bx bx-search search-icon'></i>
                <input type="text" class="search-input" placeholder="Cari Komoditas ..." />
            </div>
            <button class="tambah" onclick="openModal('modal-komoditas'); CommodityService.HandleNew();">
                <span>Tambah Komoditas</span>
            </button>
        </div>
        <div class="table-container">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th><input type="checkbox" /></th>
                        <th class="title-table">No</th>
                        <th class="title-table">Icon</th>
                        <th class="title-table">Nama Komoditas</th>
                        <th class="title-table">Satuan</th>
                        <th class="title-table">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $commodities = $connection->query("SELECT * FROM commodities");
                    foreach ($commodities as $i => $commodity):
                        ?>
                        <tr>
                            <td><input type="checkbox" /></td>
                            <td><?= $i += 1 ?></td>
                            <td style="font-size: 17px"><?= $commodity["icon"] ?></td>
                            <td><?= $commodity["name"] ?></td>
                            <td><?= $commodity["unit"] ?></td>
                            <td>
                                <button class="btn-aksi edit"
                                    onclick="openModal('modal-komoditas'); CommodityService.HandleEdit(<?= $commodity['id'] ?>);"><i
                                        class='bx bx-edit'></i></button>
                                <button class="btn-aksi delete"
                                    onclick="CommodityService.ConfirmAndDelete(event, <?= $commodity['id'] ?>)"><i
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
    <script src="pages/admin/services/CommodityService.js"></script>
</body>

</html>