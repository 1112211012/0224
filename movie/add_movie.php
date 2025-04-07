<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli("localhost", "root", "", "school");
    if ($conn->connect_error) {
        die("連接失敗: " . $conn->connect_error);
    }
    $conn->set_charset("utf8mb4");

    $title = $_POST['title'];
    $year = $_POST['year'];
    $director = $_POST['director'];
    $mtype = $_POST['mtype'];
    $mdate = $_POST['mdate'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("INSERT INTO movie (title, year, director, mtype, mdate, content) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissss", $title, $year, $director, $mtype, $mdate, $content);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增電影</title>
    <style>
        body { background-color: #E3D5CA; font-family: "Microsoft JhengHei", Arial, sans-serif; padding: 20px; }
        .form-container { background: #B7A8A3; padding: 30px; border-radius: 10px; width: 60%; margin: auto; box-shadow: 3px 3px 10px rgba(0,0,0,0.2); }
        h2 { color: #4F4A45; text-align: center; }
        form { display: flex; flex-direction: column; gap: 15px; }
        label { font-weight: bold; color: #4F4A45; }
        input, textarea, select { padding: 10px; border-radius: 5px; border: 1px solid #ccc; }
        button { background-color: #6B5B52; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { opacity: 0.8; }
        a { display: block; text-align: center; margin-top: 10px; color: #4F4A45; text-decoration: none; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>新增電影資料</h2>
        <form method="post">
            <label for="title">電影名稱</label>
            <input type="text" id="title" name="title" required>

            <label for="year">發行年份</label>
            <input type="number" id="year" name="year" required>

            <label for="director">導演</label>
            <input type="text" id="director" name="director" required>

            <label for="mtype">類型</label>
            <input type="text" id="mtype" name="mtype" required>

            <label for="mdate">首映日期</label>
            <input type="date" id="mdate" name="mdate" required>

            <label for="content">電影簡介</label>
            <textarea id="content" name="content" rows="5" required></textarea>

            <button type="submit">新增電影</button>
        </form>
        <a href="index.php">返回列表</a>
    </div>
</body>
</html>