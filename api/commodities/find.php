<?php

require_once "../../configs/connection.php";

$id = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] === "GET" && $id) {
    $sql = "SELECT * FROM commodities WHERE id = '$id'";
    $result = $connection->query($sql);
    $data = $result->fetch_assoc();

    if ($result) {
        http_response_code(200);
        echo json_encode(["message" => "success", "data" => $data]);
    }
}
?>