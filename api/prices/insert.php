<?php

require_once "../../configs/connection.php";

$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["REQUEST_METHOD"] === "POST" && $data) {
    $market = mysqli_real_escape_string($connection, $data['market']);
    $commodity = mysqli_real_escape_string($connection, $data['commodity']);
    $price = mysqli_real_escape_string($connection, $data['price']);
    $status = 'Stabil';
    $percent = 0;
    $user = 1;

    $check = $connection->query("SELECT COUNT(*) as `count` FROM market_commodities WHERE id_commodity = '$commodity' AND id_market = '$market'")->fetch_assoc();
    $count = $check['count'];

    if ($count > 0) {
        http_response_code(400);
        echo json_encode(["message" => "error"]);
        return;
    } else {
        $result = $connection->query("INSERT INTO market_commodities VALUES(null, '$market', '$commodity', '$price', '$status', '$percent', '$user', NOW(), null)");

        if ($result) {
            http_response_code(200);
            echo json_encode(["message" => "success"]);
        }
    }
}
?>