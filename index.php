<?php

$router = $_GET['route'] ?? "";

switch ($router) {
    case '':
        require 'pages/beranda.php';
        break;

    case '/harga':
        require 'pages/harga.php';
        break;
        
    case '/admin':
        require 'pages/admin/beranda.php';
        break;

    case '/admin/kelola-komoditas':
        require 'pages/admin/kelola_komoditas.php';
        break;

    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
}
?>