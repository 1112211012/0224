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

// 獲取書籍 ID
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// 查詢單筆書籍資料
$sql = "SELECT * FROM book WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h2>書籍詳細資料</h2>";
    echo "<p><strong>書名：</strong>" . htmlspecialchars($row["bookname"]) . "</p>";
    echo "<p><strong>作者：</strong>" . htmlspecialchars($row["author"]) . "</p>";
    echo "<p><strong>出版社：</strong>" . htmlspecialchars($row["publisher"]) . "</p>";
    echo "<p><strong>出版日期：</strong>" . $row["pubdate"] . "</p>";
    echo "<p><strong>價格：</strong>" . $row["price"] . " 元</p>";
    echo "<p><strong>內容：</strong><br>" . nl2br(htmlspecialchars($row["content"])) . "</p>";
    echo "<a href='index.php'>返回列表</a>";
} else {
    echo "<p>找不到該書籍資料。</p>";
    echo "<a href='index.php'>返回列表</a>";
}

// 關閉連接
$stmt->close();
$conn->close();
?>
