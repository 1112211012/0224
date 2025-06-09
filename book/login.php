<?php
session_start();
include("dbconfig.php");

$conn = new mysqli("localhost", "root", "", "school");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

$result = $conn->query("SELECT * FROM book");
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>書籍列表</title>
    <style>
        body { background-color: #E3D5CA; font-family: "Microsoft JhengHei", sans-serif; padding: 20px; }
        table { width: 80%; margin: auto; border-collapse: collapse; }
        th, td { padding: 12px; text-align: center; border: 1px solid #B7A8A3; }
        th { background-color: #B7A8A3; color: white; }
        tr:nth-child(even) { background-color: #F5F5F5; }
        a, button { color: #4F4A45; text-decoration: none; font-size: 16px; }
        .btn { background-color: #6B5B52; color: white; padding: 10px 15px; border-radius: 5px; cursor: pointer; border: none; }
        .btn:hover { opacity: 0.8; }
        .actions { display: flex; justify-content: space-around; }
        .top-bar { text-align: right; margin-bottom: 15px; }

        /* Modal styles */
        .modal { display: none; position: fixed; z-index: 999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); }
        .modal-content { background-color: #fff; margin: 10% auto; padding: 20px; width: 300px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.3); }
        .close { float: right; font-size: 20px; cursor: pointer; }
    </style>
</head>
<body>

<div class="top-bar">
    <?php if (isset($_SESSION['user'])): ?>
        歡迎 <?= htmlspecialchars($_SESSION['user']) ?>，<a href="logout.php">登出</a>
    <?php else: ?>
        <button onclick="document.getElementById('loginModal').style.display='block'" class="btn">登入</button>
        <a href="register.php" class="btn">註冊</a>
    <?php endif; ?>
</div>

<h2 style="text-align: center; color: #4F4A45;">書籍列表</h2>
<table>
    <tr>
        <th>ID</th>
        <th>書名</th>
        <th>作者</th>
        <th>出版社</th>
        <th>發行日期</th>
        <th>價格</th>
        <th>操作</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= htmlspecialchars($row['bookname']); ?></td>
            <td><?= htmlspecialchars($row['author']); ?></td>
            <td><?= htmlspecialchars($row['publisher']); ?></td>
            <td><?= $row['pubdate']; ?></td>
            <td><?= $row['price']; ?></td>
            <td class="actions">
                <a href="view.php?id=<?= $row['id']; ?>" class="btn">檢視</a>
                <a href="edit.php?id=<?= $row['id']; ?>" class="btn">修改</a>
                <a href="delete.php?id=<?= $row['id']; ?>" class="btn" onclick="return confirm('確定刪除這本書嗎？');">刪除</a>
            </td>
        </tr>
    <?php } ?>
</table>
<div style="text-align: center; margin-top: 20px;">
    <a href="add.php" class="btn">新增書籍</a>
</div>

<!-- 登入 Modal -->
<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="document.getElementById('loginModal').style.display='none'">&times;</span>
        <h3>使用者登入</h3>
        <form id="loginForm">
            <input type="hidden" name="action" value="login">
            <label>帳號：</label><br>
            <input type="text" name="username" required><br><br>
            <label>密碼：</label><br>
            <input type="password" name="userpass" required><br><br>
            <button type="submit" class="btn">登入</button>
        </form>
    </div>
</div>

<script>
document.getElementById("loginForm").addEventListener("submit", function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch("login_api.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(text => {
        if (text.trim() === "Yes") {
            alert("登入成功！");
            location.reload();
        } else {
            alert("帳號或密碼錯誤");
        }
    });
});
</script>
</body>
</html>
