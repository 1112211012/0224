<?php
include("db.php");

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // 取得指定 ID 的產品資料
    $sql = "SELECT * FROM product WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('錯誤: 找不到該產品！'); window.location.href='index.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('錯誤: 未指定產品 ID！'); window.location.href='index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>查看產品</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>📦 產品詳細資料</h1>

    <table>
        <tr>
            <th>編號</th>
            <td><?= htmlspecialchars($row['id']) ?></td>
        </tr>
        <tr>
            <th>產品名稱</th>
            <td><?= htmlspecialchars($row['pname']) ?></td>
        </tr>
        <tr>
            <th>規格</th>
            <td><?= htmlspecialchars($row['pspec']) ?></td>
        </tr>
        <tr>
            <th>價格</th>
            <td><?= htmlspecialchars($row['price']) ?></td>
        </tr>
        <tr>
            <th>上架日期</th>
            <td><?= htmlspecialchars($row['pdate']) ?></td>
        </tr>
        <tr>
            <th>描述</th>
            <td><?= nl2br(htmlspecialchars($row['content'])) ?></td>
        </tr>
    </table>

    <p><a href="index.php" class="button">返回產品列表</a></p>
</body>
</html>
