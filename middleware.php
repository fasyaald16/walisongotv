<?php
session_start();

// anti cache (penting untuk tombol back)
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

// belum login
if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

// fungsi cek role
function onlyAdmin() {
    if ($_SESSION['role'] != 'admin') {
        header("Location: ../index.php");
        exit;
    }
}

function onlyUser() {
    if ($_SESSION['role'] != 'user') {
        header("Location: ../admin/dashboard.php");
        exit;
    }
}
?>