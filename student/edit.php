<?php
// create.php - 新增學生資料
$conn = new mysqli("localhost", "root", "", "school");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $schid = $_POST['schid'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $stmt = $conn->prepare("INSERT INTO student (schid, name, gender, birthday, email, address) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $schid, $name, $gender, $birthday, $email, $address);
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
    <title>新增學生</title>
    <style>
        body { background-color: #E3D5CA; font-family: "Microsoft JhengHei", sans-serif; padding: 20px; }
        .form-container { background: #B7A8A3; padding: 30px; border-radius: 10px; width: 60%; margin: auto; box-shadow: 3px 3px 10px rgba(0,0,0,0.2); }
        h2 { color: #4F4A45; text-align: center; }
        form { display: flex; flex-direction: column; gap: 15px; }
        label { font-weight: bold; color: #4F4A45; }
        input, select { padding: 10px; border-radius: 5px; border: 1px solid #ccc; color: #000; }
        button { background-color: #6B5B52; color: #000; padding: 10px; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { opacity: 0.8; }
        a { display: block; text-align: center; margin-top: 10px; color: #4F4A45; text-decoration: none; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>新增學生資料</h2>
        <form method="post">
            <label for="schid">學號</label>
            <input type="text" id="schid" name="schid" required>

            <label for="name">姓名</label>
            <input type="text" id="name" name="name" required>

            <label for="gender">性別</label>
            <select id="gender" name="gender" required>
                <option value="M">男</option>
                <option value="F">女</option>
            </select>

            <label for="birthday">生日</label>
            <input type="date" id="birthday" name="birthday" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="address">地址</label>
            <input type="text" id="address" name="address" required>

            <button type="submit">新增學生</button>
        </form>
        <a href="index.php">返回列表</a>
    </div>
</body>
</html>
