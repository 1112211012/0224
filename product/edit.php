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
    <title>修改產品</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>✏️ 修改產品</h1>
    <form method="post" action="update.php">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">

        <label for="pname">產品名稱：</label>
        <input type="text" id="pname" name="pname" value="<?= htmlspecialchars($row['pname']) ?>" required>

        <label for="pspec">規格：</label>
        <input type="text" id="pspec" name="pspec" value="<?= htmlspecialchars($row['pspec']) ?>" required>

        <label for="price">價格：</label>
        <input type="number" id="price" name="price" value="<?= htmlspecialchars($row['price']) ?>" required>

        <label for="pdate">上架日期：</label>
        <input type="date" id="pdate" name="pdate" value="<?= $row['pdate'] ?>" required>

        <label for="content">描述：</label>
        <textarea id="content" name="content" rows="4" required><?= htmlspecialchars($row['content']) ?></textarea>

        <input type="submit" value="更新產品">
    </form>

    <p><a href="index.php" class="button">返回產品列表</a></p>
</body>
</html>
