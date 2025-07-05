<?php

require_once "../../configs/connection.php";

$month = $_GET['month'];
$marketId = $_GET['marketId'];

if ($_SERVER["REQUEST_METHOD"] === "GET" && $month && $marketId) {
    if ($marketId == 'all') {
        $sql = "SELECT 
					MAX(commodities.id) AS id,
                    MAX(commodities.name) AS name,
                    MAX(commodities.icon) AS icon,
                    MAX(commodities.unit) AS unit,
                    MAX(commodities.image) AS image,
                    MAX(markets.name) AS market_name,
                    MAX(market_commodities.price) AS price,
                    MAX(market_commodities.update_at) AS update_at,
                    MAX(market_commodities.create_at) AS create_at,
                    AVG(price_logs.price_after) AS avg_price,
                    MAX(price_logs.price_after) AS max_price,
                    MIN(price_logs.price_after) AS min_price
                FROM commodities
                LEFT JOIN market_commodities ON commodities.id = market_commodities.id_commodity
                LEFT JOIN markets ON market_commodities.id_market = markets.id
                LEFT JOIN price_logs ON price_logs.id_market_commodity = market_commodities.id
                WHERE (market_commodities.create_at LIKE '%$month%' OR market_commodities.update_at LIKE '%$month%')
                GROUP BY markets.id, commodities.id";
    } else {
        $sql = "SELECT 
					MAX(commodities.id) AS id,
                    MAX(commodities.name) AS name,
                    MAX(commodities.icon) AS icon,
                    MAX(commodities.unit) AS unit,
                    MAX(commodities.image) AS image,
                    MAX(markets.name) AS market_name,
                    MAX(market_commodities.price) AS price,
                    MAX(market_commodities.update_at) AS update_at,
                    MAX(market_commodities.create_at) AS create_at,
                    AVG(price_logs.price_after) AS avg_price,
                    MAX(price_logs.price_after) AS max_price,
                    MIN(price_logs.price_after) AS min_price
                FROM commodities
                LEFT JOIN market_commodities ON commodities.id = market_commodities.id_commodity
                LEFT JOIN markets ON market_commodities.id_market = markets.id
                LEFT JOIN price_logs ON price_logs.id_market_commodity = market_commodities.id
                WHERE markets.id = '$marketId' AND (market_commodities.create_at LIKE '%$month%' OR market_commodities.update_at LIKE '%$month%')
                GROUP BY markets.id, commodities.id";
    }

    $result = $connection->query($sql);

    $data = [];

    foreach ($result as $stats) {
        $data[] = $stats;
    }

    if ($result) {
        if (count($data) > 0) {
            http_response_code(200);
            echo json_encode(["message" => "success", "data" => $data]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "error", "data" => null]);
        }
    }
}

?>