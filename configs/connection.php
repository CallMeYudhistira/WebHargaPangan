<?php

define("DB_HOST", "r9td9.h.filess.io");
define("DB_PORT", "61002");
define("DB_USERNAME", "pangancimahi_enjoyabout");
define("DB_PASSWORD", "ebb2cc51f1c70fc3534f23082d1962e420100a37");
define("DB_DATABASE", "pangancimahi_enjoyabout");

$connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

if ($connection->connect_error) {
    die("Koneksi gagal: " . $connection->connect_error);
}

?>