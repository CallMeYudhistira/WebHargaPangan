<?php

require_once "../../configs/connection.php";

$id_market = $_GET["id_market"];
$status = $_GET["status"];
$id_kecamatan = $_GET["id_kecamatan"];

if ($_SERVER["REQUEST_METHOD"] === "GET" && $id_market && $status && $id_kecamatan) {

    if ($id_market != 'all' && $status != 'all' && $id_kecamatan != 'all') {

        $sql = "SELECT market_commodities.id_commodity, commodities.name as commodity_name, commodities.icon, commodities.unit, commodities.image, market_commodities.price, market_commodities.status, market_commodities.percent FROM market_commodities INNER JOIN commodities ON commodities.id = market_commodities.id_commodity INNER JOIN markets ON markets.id = market_commodities.id_market INNER JOIN regions ON markets.id_region = regions.id WHERE markets.id = '$id_market' AND market_commodities.status = '$status' AND regions.id = '$id_kecamatan'";

    } if ($id_market == 'all' && $status == 'all' && $id_kecamatan != 'all') {

        $sql = "SELECT market_commodities.id_commodity, commodities.name as commodity_name, commodities.icon, commodities.unit, commodities.image, market_commodities.price, market_commodities.status, market_commodities.percent FROM market_commodities INNER JOIN commodities ON commodities.id = market_commodities.id_commodity INNER JOIN markets ON markets.id = market_commodities.id_market INNER JOIN regions ON markets.id_region = regions.id WHERE regions.id = '$id_kecamatan'";

    } if ($id_market != 'all' && $status == 'all' && $id_kecamatan != 'all') {

        $sql = "SELECT market_commodities.id_commodity, commodities.name as commodity_name, commodities.icon, commodities.unit, commodities.image, market_commodities.price, market_commodities.status, market_commodities.percent FROM market_commodities INNER JOIN commodities ON commodities.id = market_commodities.id_commodity INNER JOIN markets ON markets.id = market_commodities.id_market INNER JOIN regions ON markets.id_region = regions.id WHERE markets.id = '$id_market' AND regions.id = '$id_kecamatan'";

    } if ($id_market == 'all' && $status != 'all' && $id_kecamatan == 'all') {

        $sql = "SELECT market_commodities.id_commodity, commodities.name as commodity_name, commodities.icon, commodities.unit, commodities.image, market_commodities.price, market_commodities.status, market_commodities.percent FROM market_commodities INNER JOIN commodities ON commodities.id = market_commodities.id_commodity INNER JOIN markets ON markets.id = market_commodities.id_market INNER JOIN regions ON markets.id_region = regions.id WHERE market_commodities.status = '$status'";

    } if ($id_market == 'all' && $status == 'all' && $id_kecamatan == 'all') {

        $sql = "SELECT market_commodities.id_commodity, commodities.name as commodity_name, commodities.icon, commodities.unit, commodities.image, market_commodities.price, market_commodities.status, market_commodities.percent FROM market_commodities INNER JOIN commodities ON commodities.id = market_commodities.id_commodity INNER JOIN markets ON markets.id = market_commodities.id_market INNER JOIN regions ON markets.id_region = regions.id";

    }

    $result = $connection->query($sql);

    $data = [];

    foreach ($result as $commodities) {
        $data[] = $commodities;
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