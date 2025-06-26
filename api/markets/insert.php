<?php

require_once "../../configs/connection.php";

$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["REQUEST_METHOD"] === "POST" && $data) {
    $name = mysqli_real_escape_string($connection, $data['name']);
    $region = mysqli_real_escape_string($connection, $data['region']);

    $sql = "INSERT INTO markets VALUES(null, '$name', '$region')";
    $result = $connection->query($sql);

    if ($result) {
        http_response_code(200);
        echo json_encode(["message" => "success"]);
    }
}
?>