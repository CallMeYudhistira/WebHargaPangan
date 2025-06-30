<?php

$router = trim($_GET['route'] ?? "", "/");
session_start();

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
        if (!isset($_SESSION['id'])) {
            if ($_SESSION['role'] !== '2') {
                http_response_code(403);
                echo "403 Forbidden - Anda tidak diizinkan mengakses halaman ini.";
                exit;
            }
        }
        require 'pages/admin/beranda.php';
        break;

    case 'admin/kelola-komoditas':
        if (!isset($_SESSION['id']) || $_SESSION['role'] !== '2') {
            http_response_code(403);
            echo "403 Forbidden - Anda tidak diizinkan mengakses halaman ini.";
            exit;
        }
        require 'pages/admin/kelola_komoditas.php';
        break;

    case 'admin/kelola-pasar':
        if (!isset($_SESSION['id']) || $_SESSION['role'] !== '2') {
            http_response_code(403);
            echo "403 Forbidden - Anda tidak diizinkan mengakses halaman ini.";
            exit;
        }
        require 'pages/admin/kelola_pasar.php';
        break;

    case 'admin/kelola-harga':
        if (!isset($_SESSION['id']) || $_SESSION['role'] !== '2') {
            http_response_code(403);
            echo "403 Forbidden - Anda tidak diizinkan mengakses halaman ini.";
            exit;
        }
        require 'pages/admin/kelola_harga.php';
        break;

    case 'admin/log-harga':
        if (!isset($_SESSION['id']) || $_SESSION['role'] !== '2') {
            http_response_code(403);
            echo "403 Forbidden - Anda tidak diizinkan mengakses halaman ini.";
            exit;
        }
        require 'pages/admin/log_harga.php';
        break;

    case 'auth/login':
        if (isset($_SESSION['id'])) {
            http_response_code(403);
            echo "403 Forbidden - Anda tidak diizinkan mengakses halaman ini.";
            exit;
        }
        require 'pages/auth/login.php';
        break;

    case 'petugas':
        if (!isset($_SESSION['id']) || $_SESSION['role'] !== '1') {
            http_response_code(403);
            echo "403 Forbidden - Anda tidak diizinkan mengakses halaman ini.";
            exit;
        }
        require 'pages/petugas/beranda.php';
        break;

    case 'petugas/kelola-harga':
        if (!isset($_SESSION['id']) || $_SESSION['role'] !== '1') {
            http_response_code(403);
            echo "403 Forbidden - Anda tidak diizinkan mengakses halaman ini.";
            exit;
        }
        require 'pages/petugas/kelola_harga.php';
        break;

    case 'petugas/log-harga':
        if (!isset($_SESSION['id']) || $_SESSION['role'] !== '1') {
            http_response_code(403);
            echo "403 Forbidden - Anda tidak diizinkan mengakses halaman ini.";
            exit;
        }
        require 'pages/petugas/log_harga.php';
        break;

    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
}
?>