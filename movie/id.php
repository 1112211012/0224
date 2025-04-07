<?php
$conn = new mysqli("localhost", "root", "", "school");
if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM movie WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$movie = $result->fetch_assoc();
$stmt->close();
$conn->close();

if (!$movie) {
    echo "找不到電影資料";
    exit();
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>電影詳細資料</title>
    <style>
        body { background-color: #E3D5CA; font-family: "Microsoft JhengHei", Arial, sans-serif; padding: 20px; }
        .view-container { background: #B7A8A3; padding: 30px; border-radius: 10px; width: 60%; margin: auto; box-shadow: 3px 3px 10px rgba(0,0,0,0.2); }
        h2 { color: #4F4A45; text-align: center; }
        .movie-info { color: #000000; line-height: 1.8; }
        .movie-info label { font-weight: bold; display: inline-block; width: 120px; color: #4F4A45; }
        .back-link { text-align: center; margin-top: 20px; display: block; color: #4F4A45; text-decoration: none; }
    </style>
</head>
<body>
    <div class="view-container">
        <h2>電影詳細資料</h2>
        <div class="movie-info">
            <p><label>電影名稱:</label> <?php echo htmlspecialchars($movie['title']); ?></p>
            <p><label>發行年份:</label> <?php echo htmlspecialchars($movie['year']); ?></p>
            <p><label>導演:</label> <?php echo htmlspecialchars($movie['director']); ?></p>
            <p><label>類型:</label> <?php echo htmlspecialchars($movie['mtype']); ?></p>
            <p><label>首映日期:</label> <?php echo htmlspecialchars($movie['mdate']); ?></p>
            <p><label>電影簡介:</label><br> <?php echo nl2br(htmlspecialchars($movie['content'])); ?></p>
        </div>
        <a href="index.php" class="back-link">返回列表</a>
    </div>
</body>
</html>
