<?php

require_once "../../configs/connection.php";

$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["REQUEST_METHOD"] === "POST" && $data) {
    $keyword = mysqli_real_escape_string($connection, $data['keyword']);

    $sql = "INSERT INTO search_logs VALUES (NULL, '$keyword', NOW())";
    $result = $connection->query($sql);

    if ($result) {
        http_response_code(200);
        echo json_encode(["message" => "success"]);
    }
}

?>