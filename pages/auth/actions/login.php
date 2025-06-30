<?php
session_start();
require_once '../../../configs/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $connection->query($query);
    if ($result->num_rows === 1) {
        $data = $result->fetch_assoc();
        $_SESSION['id'] = $data['id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['name'] = $data['name'];
        $_SESSION['role'] = $data['id_role'];
        $_SESSION['email'] = $data['email'];
        if($data['id_role'] == 2) {
            header('location: ../../../index.php?route=/admin');
        } else if($data['id_role'] == 1) {
            header('location: ../../../index.php?route=/petugas');
        } else {
            echo "<script>alert('Hak Akses Tidak Tersedia !'); window.location.href = '../../../index.php'</script>";
        }
    } else {
        echo "
            <script>alert('Username / Password Salah !'); window.location.href = '../../../index.php'</script>";
    }
}
