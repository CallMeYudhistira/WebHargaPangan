<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Kelola Komoditas</title>
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../assets/css/admin/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
    <?php include "includes/header.php" ?>
    <section class="kelola-komoditas">
        <div class="kelola-aksi">
            <div class="search-container">
                <i class='bx bx-search search-icon'></i>
                <input type="text" class="search-input" placeholder="Cari Komoditas ..." />
            </div>
            <button class="tambah">
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
                    <tr>
                        <td><input type="checkbox" checked /></td>
                        <td>No</td>
                        <td>🌶️</td>
                        <td>Cabe Merah</td>
                        <td>KG</td>
                        <td>
                            <button class="btn-aksi edit"><i class='bx bx-edit'></i></button>
                            <button class="btn-aksi delete"><i class='bx bx-trash'></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>