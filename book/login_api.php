<?php
session_start();
include("dbconfig.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $userpass = $_POST['userpass'] ?? '';

    // 防止 SQL Injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND userpass = ?");
    $stmt->bind_param("ss", $username, $userpass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $_SESSION['user'] = $username;
        echo "Yes";
    } else {
        echo "No";
    }
}
?>
