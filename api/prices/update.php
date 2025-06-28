<?php

require_once "../../configs/connection.php";

$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["REQUEST_METHOD"] === "POST" && $data) {
    $id = mysqli_real_escape_string($connection, $data['id']);
    $market = mysqli_real_escape_string($connection, $data['market']);
    $commodity = mysqli_real_escape_string($connection, $data['commodity']);
    $price = mysqli_real_escape_string($connection, $data['price']);
    $status = 'Stabil';
    $percent = 0;
    $user = 1;

    $old = $connection->query("SELECT * FROM market_commodities WHERE id = '$id'")->fetch_assoc();
    $oldPrice = $old['price'];
    $oldStatus = $old['status'];
    $oldPercent = $old['percent'];

    if ($price > $oldPrice) {
        $status = "Naik";
        $percent = (($price - $oldPrice) / $oldPrice) * 100;
    } else if ($price < $oldPrice) {
        $status = "Turun";
        $percent = (($price - $oldPrice) / $oldPrice) * 100;
    } else {
        $status = "Stabil";
        $percent = 0;
    }

    $new = $connection->query("UPDATE market_commodities SET id_market='$market', id_commodity='$commodity', price='$price', status='$status', percent='$percent', id_user='$user', update_at=NOW() WHERE id='$id';");

    $log = $connection->query("INSERT INTO price_logs SELECT null, '$user', '$id', '$oldPrice', market_commodities.price, '$oldStatus', market_commodities.status, '$oldPercent', market_commodities.percent, NOW() FROM market_commodities WHERE id = '$id'");

    if ($new AND $log) {
        http_response_code(200);
        echo json_encode(["message" => "success"]);
    }
}
?>