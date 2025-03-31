<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

// 建立連接
$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連接
if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

// 設定字元編碼
$conn->set_charset("utf8mb4");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    // 刪除書籍
    $sql = "DELETE FROM book WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "<p style='color: green;'>書籍刪除成功！</p>";
    } else {
        echo "<p style='color: red;'>刪除失敗: " . $stmt->error . "</p>";
    }
    
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>刪除書籍</title>
    <style>
        body { background-color: #E3D5CA; font-family: Arial, sans-serif; padding: 20px; text-align: center; }
        .container { background: #B7A8A3; padding: 20px; border-radius: 10px; width: 400px; margin: auto; }
        p { color: #4F4A45; }
        a { display: inline-block; margin-top: 10px; background-color: #8D7B68; color: white; padding: 10px; text-decoration: none; border-radius: 5px; }
        a:hover { background-color: #6B5B52; }
    </style>
</head>
<body>
    <div class="container">
        <h2>刪除書籍</h2>
        <p>刪除操作已執行。</p>
        <a href="index.php">返回列表</a>
    </div>
</body>
</html>
