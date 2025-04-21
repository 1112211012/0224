<?php
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 獲取表單資料
    $pname = $_POST['pname'];
    $pspec = $_POST['pspec'];
    $price = $_POST['price'];
    $pdate = $_POST['pdate'];
    $content = $_POST['content'];

    // 插入資料到資料庫
    $sql = "INSERT INTO product (pname, pspec, price, pdate, content) 
            VALUES ('$pname', '$pspec', '$price', '$pdate', '$content')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('新增成功！'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('錯誤: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>新增產品</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>➕ 新增產品</h1>
    <form method="post">
        <label for="pname">產品名稱：</label>
        <input type="text" id="pname" name="pname" required>

        <label for="pspec">規格：</label>
        <input type="text" id="pspec" name="pspec" required>

        <label for="price">價格：</label>
        <input type="number" id="price" name="price" required>

        <label for="pdate">上架日期：</label>
        <input type="date" id="pdate" name="pdate" required>

        <label for="content">描述：</label>
        <textarea id="content" name="content" rows="4" required></textarea>

        <input type="submit" value="新增產品">
    </form>

    <p><a href="index.php" class="button">返回產品列表</a></p>
</body>
</html>
