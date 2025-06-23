<?php

$data = [];

for ($i = 1; $i <= 100; $i++) { 
    if($i % 2 == 0){
        $komoditas = 'Cabai Keriting Merah';
        $status = 'naik';
        $harga = 'Rp. 14.000';
        $selisih = 'Rp. 5.000';
        $persen = '3,4%';
        $foto = 'https://cdn1-production-images-kly.akamaized.net/kc_9Zp04KboUOMeRHBZuWxGMmCc=/1200x675/smart/filters:quality(75):strip_icc():format(jpeg)/kly-media-production/medias/3778233/original/052183900_1640087857-20211221-Cabai-Rawit-Merah-8.jpg';
    } else {
        $komoditas = 'Cabai Rawit Merah';
        $status = 'turun';
        $harga = 'Rp. 15.500';
        $selisih = 'Rp. 500';
        $persen = '0,6%';
        $foto = 'https://pekalongankota.go.id/upload/berita/berita_20250110020806.jpeg';
    }
    $isi = ['id' => $i, 'komoditas' => $komoditas, 'harga' => $harga, 'status' => $status, 'selisih' => $selisih, 'persen' => $persen, 'foto' => $foto];
    $data[] = $isi;
}

$json = json_encode($data);

?>