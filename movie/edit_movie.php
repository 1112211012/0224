<?php
$conn = new mysqli("localhost", "root", "", "school");
if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $year = $_POST['year'];
    $director = $_POST['director'];
    $mtype = $_POST['mtype'];
    $mdate = $_POST['mdate'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("UPDATE movie SET title=?, year=?, director=?, mtype=?, mdate=?, content=? WHERE id=?");
    $stmt->bind_param("sissssi", $title, $year, $director, $mtype, $mdate, $content, $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: index.php");
    exit();
} elseif (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM movie WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $movie = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改電影</title>
    <style>
        body { background-color: #E3D5CA; font-family: "Microsoft JhengHei", Arial, sans-serif; padding: 20px; }
        .form-container { background: #B7A8A3; padding: 30px; border-radius: 10px; width: 60%; margin: auto; box-shadow: 3px 3px 10px rgba(0,0,0,0.2); }
        h2 { color: #4F4A45; text-align: center; }
        form { display: flex; flex-direction: column; gap: 15px; }
        label { font-weight: bold; color: #4F4A45; }
        input, textarea, select { padding: 10px; border-radius: 5px; border: 1px solid #ccc; color: #000000; }
        button { background-color: #6B5B52; color: #000000; padding: 10px; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { opacity: 0.8; }
        a { display: block; text-align: center; margin-top: 10px; color: #4F4A45; text-decoration: none; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>修改電影資料</h2>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($movie['id']); ?>">

            <label for="title">電影名稱</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($movie['title']); ?>" required>

            <label for="year">發行年份</label>
            <input type="number" id="year" name="year" value="<?php echo htmlspecialchars($movie['year']); ?>" required>

            <label for="director">導演</label>
            <input type="text" id="director" name="director" value="<?php echo htmlspecialchars($movie['director']); ?>" required>

            <label for="mtype">類型</label>
            <input type="text" id="mtype" name="mtype" value="<?php echo htmlspecialchars($movie['mtype']); ?>" required>

            <label for="mdate">首映日期</label>
            <input type="date" id="mdate" name="mdate" value="<?php echo htmlspecialchars($movie['mdate']); ?>" required>

            <label for="content">電影簡介</label>
            <textarea id="content" name="content" rows="5" required><?php echo htmlspecialchars($movie['content']); ?></textarea>

            <button type="submit">更新電影</button>
        </form>
        <a href="index.php">返回列表</a>
    </div>
</body>
</html>
