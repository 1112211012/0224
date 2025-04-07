<?php
if (isset($_GET['id'])) {
    $conn = new mysqli("localhost", "root", "", "school");
    if ($conn->connect_error) {
        die("連接失敗: " . $conn->connect_error);
    }
    $conn->set_charset("utf8mb4");

    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM movie WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

header("Location: index.php");
exit();
?>
