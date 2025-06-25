<?php

require_once "../../configs/connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $icon = mysqli_real_escape_string($connection, $_POST['icon']);
    $unit = mysqli_real_escape_string($connection, $_POST['unit']);

    $tmpName = $_FILES['image']['tmp_name'];
    $originalName = $_FILES['image']['name'];
    $fileExtension = pathinfo($originalName, PATHINFO_EXTENSION);

    $randomName = uniqid('img_') . '.' . $fileExtension;

    $targetDir = '../../public/images/';
    $targetPath = $targetDir . $randomName;

    if (move_uploaded_file($tmpName, $targetPath)) {
        $sql = "INSERT INTO commodities VALUES (NULL, '$name', '$icon', '$unit', '$randomName')";
        $result = $connection->query($sql);

        if ($result) {
            http_response_code(200);
            echo json_encode(["message" => "success"]);
        }
    }
}
?>