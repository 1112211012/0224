<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "school"; // 請自行更換

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
?>
