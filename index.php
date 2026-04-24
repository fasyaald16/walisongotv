<?php
session_start();

// 🔥 anti cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

// 🔒 harus login
if (!isset($_SESSION['login'])) {
    header("Location: auth/login.php");
    exit;
}

// 🔒 hanya user (mahasiswa)
if ($_SESSION['role'] != 'user') {
    header("Location: ../admin/dashboard.php");
    exit;
}
?>

<h3>Welcome, <?= $_SESSION['nama']; ?></h3>
<? $photo = $_SESSION['photo'] ?? 'default.png'; ?>
<img src="assets/images/users/<?= $_SESSION['photo']; ?>" width="80">

<!-- logout -->
<html>
<button onclick="window.location.href='../logout.php'">Logout</button>


</html>
