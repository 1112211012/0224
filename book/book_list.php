<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("dbconfig.php");

$conn = new mysqli($hostname, $dbuser, $dbpass, $database);
if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
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
        body { background-color: #F3EDE3; font-family: "Microsoft JhengHei"; }
        table { width: 80%; margin: auto; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        .btn { background-color: #6B5B52; color: white; padding: 5px 10px; border: none; border-radius: 4px; text-decoration: none; }
        .btn:hover { opacity: 0.8; }
        .top-bar { text-align: right; margin: 20px; }
        .modal { display: none; position: fixed; z-index: 99; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); }
        .modal-content { background: white; margin: 15% auto; padding: 20px; width: 300px; border-radius: 10px; }
        .close { float: right; font-size: 20px; cursor: pointer; }
    </style>
</head>
<body>

<div class="top-bar">
    <?php if (isset($_SESSION['user'])): ?>
        歡迎 <?= htmlspecialchars($_SESSION['user']) ?>，<a href="logout.php" class="btn">登出</a>
    <?php else: ?>
        <button class="btn" onclick="document.getElementById('loginModal').style.display='block'">登入</button>
        <a href="register.php" class="btn">註冊</a>
    <?php endif; ?>
</div>

<h2 style="text-align:center;">書籍列表</h2>
<table>
    <tr>
        <th>ID</th><th>書名</th><th>作者</th><th>出版社</th><th>發行日</th><th>價格</th><th>操作</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['bookname']) ?></td>
        <td><?= htmlspecialchars($row['author']) ?></td>
        <td><?= htmlspecialchars($row['publisher']) ?></td>
        <td><?= $row['pubdate'] ?></td>
        <td><?= $row['price'] ?></td>
        <td>
            <a class="btn" href="view.php?id=<?= $row['id'] ?>">檢視</a>
            <?php if (isset($_SESSION['user'])): ?>
                <a class="btn" href="edit.php?id=<?= $row['id'] ?>">修改</a>
                <a class="btn" href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('確定刪除？')">刪除</a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php if (isset($_SESSION['user'])): ?>
<div style="text-align:center; margin-top: 20px;">
    <a href="add.php" class="btn">新增書籍</a>
</div>
<?php endif; ?>

<!-- 登入 Modal -->
<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="document.getElementById('loginModal').style.display='none'">&times;</span>
        <h3>使用者登入</h3>
        <form id="loginForm">
            <label>帳號：</label><input type="text" name="username" required><br><br>
            <label>密碼：</label><input type="password" name="userpass" required><br><br>
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
            alert("登入成功");
            location.reload();
        } else {
            alert("帳號或密碼錯誤");
        }
    });
});
</script>

</body>
</html>
