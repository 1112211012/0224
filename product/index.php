<?php
include("db.php");

// 取得目前頁數
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// 總筆數
$total_result = $conn->query("SELECT COUNT(*) AS total FROM product");
$total_row = $total_result->fetch_assoc();
$total = $total_row['total'];
$total_pages = ceil($total / $limit);

// 取得產品資料
$sql = "SELECT * FROM product ORDER BY id DESC LIMIT $offset, $limit";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>產品列表</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>📦 產品列表</h1>
    <p><a href="add.php" class="button">➕ 新增產品</a></p>

    <table>
        <tr>
            <th>編號</th>
            <th>名稱</th>
            <th>規格</th>
            <th>價格</th>
            <th>日期</th>
            <th>操作</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['pname']) ?></td>
            <td><?= htmlspecialchars($row['pspec']) ?></td>
            <td><?= htmlspecialchars($row['price']) ?></td>
            <td><?= htmlspecialchars($row['pdate']) ?></td>
            <td>
                <a class="button" href="view.php?id=<?= $row['id'] ?>">查看</a>
                <a class="button" href="edit.php?id=<?= $row['id'] ?>">修改</a>
                <a class="button" href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('確定要刪除嗎？')">刪除</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <!-- 分頁 -->
    <div style="margin-top:20px;">
        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
            <a class="button" href="?page=<?= $i ?>"><?= $i ?></a>
        <?php } ?>
    </div>
</body>
</html>
