<?php

require 'config.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli(HOST, USER, PASSWORD, BASE_DE_DADOS);
    $conn->set_charset("utf8mb4");

} catch (mysqli_sql_exception $e) {

    header("Location: error.php");
    exit();
}