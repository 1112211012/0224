<?php
$conn = new mysqli("localhost", "root", "", "school");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

$result = $conn->query("SELECT * FROM book");

$conn->close();
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>書籍列表</title>
    <style>
        body { background-color: #E3D5CA; font-family: "Microsoft JhengHei", sans-serif; padding: 20px; }
        table { width: 80%; margin: auto; border-collapse: collapse; }
        th, td { padding: 12px; text-align: center; border: 1px solid #B7A8A3; }
        th { background-color: #B7A8A3; color: white; }
        tr:nth-child(even) { background-color: #F5F5F5; }
        a { color: #4F4A45; text-decoration: none; }
        .btn { background-color: #6B5B52; color: white; padding: 10px 15px; border-radius: 5px; cursor: pointer; }
        .btn:hover { opacity: 0.8; }
        .actions { display: flex; justify-content: space-around; }
    </style>
</head>
<body>
    <h2 style="text-align: center; color: #4F4A45;">書籍列表</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>書名</th>
            <th>作者</th>
            <th>出版社</th>
            <th>發行日期</th>
            <th>價格</th>
            <th>操作</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['bookname']; ?></td>
                <td><?php echo $row['author']; ?></td>
                <td><?php echo $row['publisher']; ?></td>
                <td><?php echo $row['pubdate']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td class="actions">
                    <a href="view.php?id=<?php echo $row['id']; ?>" class="btn">檢視</a>
                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn">修改</a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn" onclick="return confirm('確定刪除這本書嗎？');">刪除</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <div style="text-align: center; margin-top: 20px;">
        <a href="add.php" class="btn">新增書籍</a>
    </div>
</body>
</html>
