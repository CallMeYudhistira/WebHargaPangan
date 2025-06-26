<?php

$router = trim($_GET['route'] ?? "", "/");

switch ($router) {
    case '':
        require 'pages/user/beranda.php';
        break;

    case 'komoditas':
        require 'pages/user/komoditas.php';
        break;

    case 'statistik':
        require 'pages/user/statistik.php';
        break;

    case 'admin':
        require 'pages/admin/beranda.php';
        break;

    case 'admin/kelola-komoditas':
        require 'pages/admin/kelola_komoditas.php';
        break;

    case 'admin/kelola-pasar':
        require 'pages/admin/kelola_pasar.php';
        break;

    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
}
?>