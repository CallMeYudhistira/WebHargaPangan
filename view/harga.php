<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harga - Informasi Pangan Kota Cimahi</title>
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'navbar.php' ?>

    <div class="container">
        <h1>Tabel Harga Pangan</h1>

        <div class="form-tampil">
            <label>Pilih Periode:</label>
            <input type="date" id="dari" name="dari">
            <span> >> </span>
            <input type="date" id="sampai" name="sampai">
            <button class="tampil-btn">Tampilkan</button>

            <table class="tabel-harga">
                <thead>
                    <tr>
                        <th>Komoditas</th>
                        <th>Harga Tertinggi(Rp/KG)</th>
                        <th>Harga Terendah(Rp/KG)</th>
                        <th>Persentase Selisih</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < 100; $i++) { ?>
                        <tr>
                            <td>Cabai Merah</td>
                            <td>Rp. 75.000</td>
                            <td>Rp. 100.000</td>
                            <td>25%</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>