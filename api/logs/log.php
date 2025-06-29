<?php

require_once "../../configs/connection.php";

$id = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] === "GET" && $id) {
    $sql = "SELECT price_logs.id, price_logs.create_at as `time`, commodities.name as commodity, CONCAT(markets.name, ' - ', regions.district, ', ', regions.city) as market, price_logs.price_before, price_logs.price_after, price_logs.status_before, price_logs.status_after, price_logs.percent_before, price_logs.percent_after, users.name FROM price_logs INNER JOIN market_commodities ON market_commodities.id = price_logs.id_market_commodity INNER JOIN commodities ON commodities.id = market_commodities.id_commodity INNER JOIN markets ON markets.id = market_commodities.id_market INNER JOIN regions ON markets.id_region = regions.id INNER JOIN users ON users.id = market_commodities.id_user WHERE price_logs.id = '$id'";
    $result = $connection->query($sql);
    $data = $result->fetch_assoc();

    if ($result) {
        http_response_code(200);
        echo json_encode(["message" => "success", "data" => $data]);
    }
}
?>