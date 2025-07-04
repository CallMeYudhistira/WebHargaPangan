<?php

require_once "../../configs/connection.php";

$id = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] === "GET" && $id) {

    $sql = "SELECT 
                commodities.id, 
                commodities.name,
                price_logs.price_after AS price_after,
                DATE_FORMAT(price_logs.create_at, '%d %M, %H:%m') AS tanggal
            FROM commodities
            INNER JOIN market_commodities ON commodities.id = market_commodities.id_commodity
            INNER JOIN price_logs ON price_logs.id_market_commodity = market_commodities.id
            WHERE commodities.id = '$id'
            ORDER BY price_logs.create_at;";

    $result = $connection->query($sql);

    $data = [];

    foreach ($result as $market) {
        $data[] = $market;
    }

    if ($result) {
        http_response_code(200);
        echo json_encode(["message" => "success", "data" => $data]);
    }
}

?>