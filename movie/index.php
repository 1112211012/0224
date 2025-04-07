<?php
require 'school';
$stmt = $pdo->query("SELECT * FROM movie");
$movies = $stmt->fetchAll();
?>

<link rel="stylesheet" href="style.css">

<h1>電影清單</h1>
<a class="button" href="create.php">新增電影</a>
<table>
    <tr>
        <th>名稱</th><th>年份</th><th>導演</th><th>操作</th>
    </tr>
    <?php foreach ($movies as $m): ?>
    <tr>
        <td><a href="show.php?id=<?= $m['id'] ?>"><?= htmlspecialchars($m['title']) ?></a></td>
        <td><?= $m['year'] ?></td>
        <td><?= htmlspecialchars($m['director']) ?></td>
        <td>
            <a href="edit.php?id=<?= $m['id'] ?>">修改</a> | 
            <a href="?delete=<?= $m['id'] ?>" onclick="return confirm('確認刪除？')">刪除</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM movie WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: index.php");
    exit;
}
?>
