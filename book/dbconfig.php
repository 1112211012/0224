<?php
# 資料庫設定
$hostname = 'localhost';  // 主機名稱
$database = 'school';     // 資料庫名稱
$dbuser = 'root';         // 使用者名稱
$dbpass = '';             // 密碼

// 資料庫連線
$conn = new mysqli($hostname, $dbuser, $dbpass, $database);

// 檢查連線是否成功
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

// 首頁設定
$main = 'db_list.php';
?>
