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

// 讀取學生列表
$sql = "SELECT * FROM student";
$result = $conn->query($sql);
$conn->close();
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>學生資料列表</title>
    <style>
        body { background-color: #E3D5CA; font-family: "Microsoft JhengHei", Arial, sans-serif; padding: 20px; text-align: center; }
        .container { background: #B7A8A3; padding: 20px; border-radius: 10px; width: 80%; margin: auto; box-shadow: 3px 3px 10px rgba(0,0,0,0.2); }
        h2 { color: #4F4A45; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: #F5F5F5; }
        th, td { padding: 10px; border: 1px solid #887F7A; text-align: left; }
        th { background-color: #8D7B68; color: white; }
        a { display: inline-block; margin: 5px; padding: 8px; text-decoration: none; color: white; border-radius: 5px; }
        .add-btn { background-color: #6B5B52; }
        .delete-btn { background-color: #C44D58; }
        a:hover { opacity: 0.8; }
        .btn-container { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>學生資料列表</h2>
        <div class="btn-container">
            <a href="add_student.php" class="add-btn">新增學生</a>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>學號</th>
                <th>姓名</th>
                <th>性別</th>
                <th>生日</th>
                <th>Email</th>
                <th>住址</th>
                <th>操作</th>
            </tr>
            <?php if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['schid'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['birthday'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "<td><a href='delete_student.php?id=" . $row['id'] . "' class='delete-btn' onclick='return confirm(\"確定要刪除這個學生資料嗎？\");'>刪除</a> 
                              <a href='edit_student.php?id=" . $row['id'] . "' class='add-btn'>修改</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>沒有學生資料</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
