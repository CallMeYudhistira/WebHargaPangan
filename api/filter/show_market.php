<?php

require_once "../../configs/connection.php";

$id = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] === "GET" && $id) {

    $sql = "SELECT * FROM markets WHERE id_region = '$id'";

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