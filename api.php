<?php

$data = [];

for ($i = 1; $i <= 12; $i++) { 
    if($i % 2 == 0){
        $komoditas = 'Cabai Keriting Merah';
        $status = 'naik';
        $harga = 'Rp. 14.000';
        $persen = '0,7%';
        $tinggi = 'Rp. 20.000';
        $rendah = 'Rp. 10.000';
        $foto = 'https://cdn1-production-images-kly.akamaized.net/kc_9Zp04KboUOMeRHBZuWxGMmCc=/1200x675/smart/filters:quality(75):strip_icc():format(jpeg)/kly-media-production/medias/3778233/original/052183900_1640087857-20211221-Cabai-Rawit-Merah-8.jpg';
    } else if($i % 3 == 0){
        $komoditas = 'Bawang Merah';
        $status = 'stabil';
        $harga = 'Rp. 10.500';
        $persen = '0%';
        $tinggi = 'Rp. 18.000';
        $rendah = 'Rp. 6.000';
        $foto = 'https://s3-publishing-cmn-svc-prd.s3.ap-southeast-1.amazonaws.com/article/tpqx_7Ik9yLWFVOeJTs4W/original/052222900_1607682083-Manfaat-Bawang-Merah_-Antialergi-hingga-Menurunkan-Risiko-Kanker-shutterstock_1724962108.jpg';
    }
    else {
        $komoditas = 'Cabai Rawit Merah';
        $status = 'turun';
        $harga = 'Rp. 15.500';
        $persen = '0,03%';
        $tinggi = 'Rp. 22.500';
        $rendah = 'Rp. 9.000';
        $foto = 'https://pekalongankota.go.id/upload/berita/berita_20250110020806.jpeg';
    }
    $isi = ['id' => $i, 'komoditas' => $komoditas, 'harga' => $harga, 'status' => $status, 'foto' => $foto, 'persen' => $persen, 'rendah' => $rendah, 'tinggi' => $tinggi];
    $data[] = $isi;
}

$json = json_encode($data);

?>