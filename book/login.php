<?php
session_start();
include("dbconfig.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // 檢查帳號格式：只允許字母、數字和底線
    if (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
        echo "<script>alert('帳號只能包含字母、數字和底線');</script>";
    } else {
        // 檢查密碼長度：至少 6 個字符
        if (strlen($password) < 6) {
            echo "<script>alert('密碼必須至少 6 個字符');</script>";
        } else {
            // 檢查帳號是否存在
            $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                // 密碼驗證
                if (password_verify($password, $row["userpass"])) {
                    $_SESSION["user"] = $row["username"];
                    echo "<script>alert('登入成功'); window.location.href='index.php';</script>";
                } else {
                    echo "<script>alert('密碼錯誤');</script>";
                }
            } else {
                echo "<script>alert('帳號不存在');</script>";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head><title>登入</title><link rel="stylesheet" href="style.css"></head>
<body>
<h2>使用者登入</h2>
<form method="post">
    <label>帳號：</label><input type="text" name="username" required><br>
    <label>密碼：</label><input type="password" name="password" required><br>
    <input type="submit" value="登入">
</form>
<p><a href="register.php">尚未註冊？點我註冊</a></p>
</body>
</html>
