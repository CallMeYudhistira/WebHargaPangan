<?php

require_once "../../configs/connection.php";

$id = $_GET["id"];
$id_market = $_GET["id_market"] ?? 'all';
$status = $_GET["status"] ?? 'all';
$id_kecamatan = $_GET["id_kecamatan"] ?? 'all';

if ($_SERVER["REQUEST_METHOD"] === "GET" && $id) {

    $sql = "SELECT 
                commodities.id, 
                commodities.name,
                price_logs.price_after AS price_after,
                DATE_FORMAT(price_logs.create_at, '%d %M, %H:%m') AS tanggal
            FROM commodities
            INNER JOIN market_commodities ON commodities.id = market_commodities.id_commodity
            INNER JOIN markets ON markets.id = market_commodities.id_market
            INNER JOIN regions ON markets.id_region = regions.id
            INNER JOIN price_logs ON price_logs.id_market_commodity = market_commodities.id";

    $conditions = [];

    if ($id !== 'all') {
        $conditions[] = "commodities.id = '$id'";
    }

    if ($id_market !== 'all') {
        $conditions[] = "markets.id = '$id_market'";
    }

    if ($status !== 'all') {
        $conditions[] = "market_commodities.status = '$status'";
    }

    if ($id_kecamatan !== 'all') {
        $conditions[] = "regions.id = '$id_kecamatan'";
    }

    // Gabungkan kondisi ke query
    if (count($conditions) > 0) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    $sql .= " ORDER BY price_logs.create_at";

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