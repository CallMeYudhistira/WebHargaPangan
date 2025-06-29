<?php

require_once "../../configs/connection.php";

$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["REQUEST_METHOD"] === "POST" && $data) {
    $id = mysqli_real_escape_string($connection, $data['id']);

    $sql = "DELETE FROM price_logs WHERE id = '$id' ";
    $result = $connection->query($sql);

    if ($result) {
        http_response_code(200);
        echo json_encode(["message" => "success"]);
    }
}
?>