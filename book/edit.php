<?php
session_start();
require_once "dbconfig.php"; // PDO 連線的設定檔
include("auth.php"); // 登入驗證

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// 處理更新資料
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)$_POST['id'];
    $bookname = $_POST['bookname'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $pubdate = $_POST['pubdate'];
    $price = $_POST['price'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("UPDATE book SET bookname = :bookname, author = :author, publisher = :publisher, pubdate = :pubdate, price = :price, content = :content WHERE id = :id");
    $stmt->bindParam(':bookname', $bookname);
    $stmt->bindParam(':author', $author);
    $stmt->bindParam(':publisher', $publisher);
    $stmt->bindParam(':pubdate', $pubdate);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: book_list.php");
        exit();
    } else {
        echo "更新失敗";
    }
}

// 取得原始資料
$stmt = $conn->prepare("SELECT * FROM book WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$book = $stmt->fetch(PDO::FETCH_ASSOC);
?>
