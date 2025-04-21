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

// 設定分頁變數
$records_per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 2;
$offset = ($page - 2) * $records_per_page;

// 查詢總筆數
$total_sql = "SELECT COUNT(*) AS total FROM book";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $records_per_page);

// 查詢分頁資料
$sql = "SELECT id, bookname, author, publisher, pubdate, price, content FROM book LIMIT $offset, $records_per_page";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>書名</th><th>作者</th><th>出版社</th><th>出版日期</th><th>價格</th><th>內容</th></tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . htmlspecialchars($row["bookname"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["author"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["publisher"]) . "</td>";
        echo "<td>" . $row["pubdate"] . "</td>";
        echo "<td>" . $row["price"] . "</td>";
        echo "<td>" . nl2br(htmlspecialchars($row["content"])) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // 分頁導航
    echo "<div style='margin-top:10px;'>";
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='?page=$i' style='margin-right:5px;'>第 $i 頁</a>";
    }
    echo "</div>";
} else {
    echo "沒有資料";
}

// 關閉連接
$conn->close();
?>