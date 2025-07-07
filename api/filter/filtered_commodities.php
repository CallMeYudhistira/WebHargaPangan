<?php

require_once "../../configs/connection.php";

// Ambil parameter dari GET
$id_market     = $_GET["id_market"] ?? 'all';
$status        = $_GET["status"] ?? 'all';
$id_kecamatan  = $_GET["id_kecamatan"] ?? 'all';
$keyword       = $_GET["keyword"] ?? 'all';

if ($_SERVER["REQUEST_METHOD"] === "GET") {

    // Base SQL
    $sql = "SELECT
    c.id AS id_commodity,
    c.name AS commodity_name,
    c.icon,
    c.unit,
    c.image,
    mc.price,
    mc.status,
    mc.percent,
    mc.create_at
FROM
    market_commodities mc
INNER JOIN (
    SELECT
        id_commodity,
        MAX(create_at) AS latest_create_at
    FROM
        market_commodities
    GROUP BY
        id_commodity
) latest_mc
ON
    mc.id_commodity = latest_mc.id_commodity
    AND mc.create_at = latest_mc.latest_create_at
INNER JOIN commodities c ON c.id = mc.id_commodity
INNER JOIN markets m ON m.id = mc.id_market
INNER JOIN regions r ON m.id_region = r.id";

    // Kondisi dinamis
    $conditions = [];

    if ($id_market !== 'all') {
        $conditions[] = "m.id = '$id_market'";
    }

    if ($status !== 'all') {
        $conditions[] = "latest_mc.status = '$status'";
    }

    if ($id_kecamatan !== 'all') {
        $conditions[] = "r.id = '$id_kecamatan'";
    }

    if ($keyword !== 'all') {
        $conditions[] = "c.name LIKE '%$keyword%'";
    }

    // Gabungkan kondisi ke query
    if (count($conditions) > 0) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    $result = $connection->query($sql);
    $data = [];

    foreach ($result as $row) {
        $data[] = $row;
    }

    if ($result && count($data) > 0) {
        http_response_code(200);
        echo json_encode(["message" => "success", "data" => $data]);
    } else {
        http_response_code(400);
        echo json_encode(["message" => "error", "data" => null]);
    }
}

?>
