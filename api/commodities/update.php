<?php

require_once "../../configs/connection.php";
ini_set('display_errors', 0);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = mysqli_real_escape_string($connection, $_POST['id']);
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $icon = mysqli_real_escape_string($connection, $_POST['icon']);
    $unit = mysqli_real_escape_string($connection, $_POST['unit']);

    $result;

    if (isset($_FILES["image"]) && $_FILES['image']['error'] === 0) {
        $tmpName = $_FILES['image']['tmp_name'];
        $originalName = $_FILES['image']['name'];
        $fileExtension = pathinfo($originalName, PATHINFO_EXTENSION);
        $randomName = uniqid('img_') . '.' . $fileExtension;

        $targetDir = '../../public/images/';
        if (!is_dir($targetDir))
            mkdir($targetDir, 0777, true);
        $targetPath = $targetDir . $randomName;

        if (move_uploaded_file($tmpName, $targetPath)) {
            $sql = "UPDATE commodities SET name = '$name', icon = '$icon', unit = '$unit', image = '$randomName' WHERE id = '$id'";
            $result = $connection->query($sql);
        }
    } else {
        $sql = "UPDATE commodities SET name = '$name', icon = '$icon', unit = '$unit' WHERE id = '$id'";
        $result = $connection->query($sql);
    }

    if ($result) {
        http_response_code(200);
        echo json_encode(["message" => "success"]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "failed"]);
    }
}
