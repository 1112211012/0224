<?php
// 這是學生資料的主列表 index.php
$conn = new mysqli("localhost", "root", "", "school");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
$result = $conn->query("SELECT * FROM student");
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>學生資料管理</title>
    <style>
        body { background-color: #E3D5CA; font-family: "Microsoft JhengHei", sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; background-color: #FFF; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; color: #000; }
        th { background-color: #B7A8A3; color: #4F4A45; }
        h2 { color: #4F4A45; text-align: center; }
        a.button { background-color: #A49393; color: #000; padding: 6px 12px; border-radius: 5px; text-decoration: none; margin-right: 5px; }
        a.button:hover { opacity: 0.8; }
        .top-bar { text-align: right; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h2>學生資料列表</h2>
    <div class="top-bar">
        <a href="create.php" class="button">新增學生</a>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>學號</th>
            <th>姓名</th>
            <th>性別</th>
            <th>生日</th>
            <th>Email</th>
            <th>地址</th>
            <th>操作</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['schid']) ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['gender']) ?></td>
            <td><?= $row['birthday'] ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['address']) ?></td>
            <td>
                <a class="button" href="view.php?id=<?= $row['id'] ?>">檢視</a>
                <a class="button" href="edit.php?id=<?= $row['id'] ?>">修改</a>
                <a class="button" href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('確定要刪除?');">刪除</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
<?php $conn->close(); ?>
