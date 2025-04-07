<?php
// view.php - 檢視學生資料
$conn = new mysqli("localhost", "root", "", "school");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM student WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
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
    <title>檢視學生資料</title>
    <style>
        body { background-color: #E3D5CA; font-family: "Microsoft JhengHei", sans-serif; padding: 20px; }
        .details-container { background: #B7A8A3; padding: 30px; border-radius: 10px; width: 60%; margin: auto; box-shadow: 3px 3px 10px rgba(0,0,0,0.2); }
        h2 { color: #4F4A45; text-align: center; }
        p { color: #4F4A45; font-size: 18px; }
        .label { font-weight: bold; }
        a { display: block; text-align: center; margin-top: 20px; color: #4F4A45; text-decoration: none; }
    </style>
</head>
<body>
    <div class="details-container">
        <h2>學生資料</h2>
        <p><span class="label">學號:</span> <?php echo htmlspecialchars($student['schid']); ?></p>
        <p><span class="label">姓名:</span> <?php echo htmlspecialchars($student['name']); ?></p>
        <p><span class="label">性別:</span> <?php echo ($student['gender'] == 'M' ? '男' : '女'); ?></p>
        <p><span class="label">生日:</span> <?php echo htmlspecialchars($student['birthday']); ?></p>
        <p><span class="label">Email:</span> <?php echo htmlspecialchars($student['email']); ?></p>
        <p><span class="label">地址:</span> <?php echo htmlspecialchars($student['address']); ?></p>
        <a href="index.php">返回列表</a>
    </div>
</body>
</html>
