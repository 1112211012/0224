<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo "<script>alert('請先登入才能執行此操作'); window.location.href='login.php';</script>";
    exit;
}
