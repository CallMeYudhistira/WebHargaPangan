<?php

require_once "../../configs/connection.php";

$month = $_GET['month'];
$marketId = $_GET['marketId'];

if ($_SERVER["REQUEST_METHOD"] === "GET" && $month && $marketId) {
    if ($marketId == 'all') {
        $sql = "SELECT 
                    c.id,
                    c.name,
                    c.icon,
                    c.unit,
                    c.image,
                    m.name AS market_name,
                    mc.update_at,
                    mc.create_at,
                    AVG(pl.price_after) AS avg_price,
                    MAX(pl.price_after) AS max_price,
                    MIN(pl.price_after) AS min_price
                FROM commodities c
                INNER JOIN market_commodities mc ON c.id = mc.id_commodity
                INNER JOIN markets m ON mc.id_market = m.id
                INNER JOIN price_logs pl ON pl.id_market_commodity = mc.id
                WHERE mc.create_at LIKE '%$month%' OR mc.update_at LIKE '%$month%'
                GROUP BY 
                    c.id,
                    c.name,
                    c.icon,
                    c.unit,
                    mc.update_at,
                    mc.create_at,
                    c.image,
                    m.name";
    } else {
        $sql = "SELECT 
                    c.id,
                    c.name,
                    c.icon,
                    c.unit,
                    c.image,
                    m.name AS market_name,
                    mc.update_at,
                    mc.create_at,
                    AVG(pl.price_after) AS avg_price,
                    MAX(pl.price_after) AS max_price,
                    MIN(pl.price_after) AS min_price
                FROM commodities c
                INNER JOIN market_commodities mc ON c.id = mc.id_commodity
                INNER JOIN markets m ON mc.id_market = m.id
                INNER JOIN price_logs pl ON pl.id_market_commodity = mc.id
                WHERE m.id = '$marketId' AND (mc.create_at LIKE '%$month%' OR mc.update_at LIKE '%$month%')
                GROUP BY 
                    c.id,
                    c.name,
                    c.icon,
                    c.unit,
                    mc.update_at,
                    mc.create_at,
                    c.image,
                    m.name";
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