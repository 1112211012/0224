<?php
include("db.php");

// 確認是否有傳送 id 參數
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // 刪除產品資料
    $sql = "DELETE FROM product WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('刪除成功！'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('刪除失敗: " . $conn->error . "');</script>";
    }
} else {
    echo "<script>alert('錯誤: 未指定要刪除的產品。'); window.location.href='index.php';</script>";
}
?>
