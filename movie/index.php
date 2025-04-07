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

// 讀取電影資料
$sql = "SELECT * FROM movie";
$result = $conn->query($sql);
$conn->close();
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>電影資料列表</title>
    <style>
        body { background-color: #E3D5CA; font-family: "Microsoft JhengHei", Arial, sans-serif; padding: 20px; text-align: center; }
        .container { background: #B7A8A3; padding: 20px; border-radius: 10px; width: 90%; margin: auto; box-shadow: 3px 3px 10px rgba(0,0,0,0.2); }
        h2 { color: #4F4A45; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: #F5F5F5; }
        th, td { padding: 10px; border: 1px solid #887F7A; text-align: left; }
        th { background-color: #8D7B68; color: white; }
        a { display: inline-block; margin: 5px; padding: 8px; text-decoration: none; color: white; border-radius: 5px; }
        .add-btn { background-color: #6B5B52; }
        .edit-btn { background-color: #4B6587; }
        .delete-btn { background-color: #C44D58; }
        a:hover { opacity: 0.8; }
    </style>
</head>
<body>
    <div class="container">
        <h2>電影資料列表</h2>
        <a href="add_movie.php" class="add-btn">新增電影</a>
        <table>
            <tr>
                <th>ID</th>
                <th>名稱</th>
                <th>年份</th>
                <th>導演</th>
                <th>類型</th>
                <th>首映日期</th>
                <th>操作</th>
            </tr>
            <?php if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td><a href='view_movie.php?id=" . $row['id'] . "'>" . $row['title'] . "</a></td>";
                    echo "<td>" . $row['year'] . "</td>";
                    echo "<td>" . $row['director'] . "</td>";
                    echo "<td>" . $row['mtype'] . "</td>";
                    echo "<td>" . $row['mdate'] . "</td>";
                    echo "<td><a href='edit_movie.php?id=" . $row['id'] . "' class='edit-btn'>修改</a> ";
                    echo "<a href='delete_movie.php?id=" . $row['id'] . "' class='delete-btn' onclick='return confirm(\"確定要刪除這部電影嗎？\");'>刪除</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>沒有電影資料</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
