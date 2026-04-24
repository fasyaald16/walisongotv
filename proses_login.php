<?php
session_start();
require_once '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php");
    exit;
}

$identity = trim($_POST['identity'] ?? '');
$password = trim($_POST['password'] ?? '');

if (empty($identity) || empty($password)) {
    $_SESSION['error'] = "Email/NIM dan Password harus diisi!";
    header("Location: ../index.php");
    exit;
}

try {
    if (filter_var($identity, FILTER_VALIDATE_EMAIL)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE nim = ?");
    }

    $stmt->execute([$identity]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {

        session_regenerate_id(true);

        $_SESSION['login'] = true;
        $_SESSION['id']    = $user['id'];
        $_SESSION['role']  = $user['role'] ?? 'user';
        $_SESSION['nama']  = $user['nama_lengkap'] ?? $user['nama'];
        $_SESSION['email'] = $user['email'] ?? '';
        $_SESSION['photo'] = $user['photo'] ?? '';

        if (strtolower($user['role']) === 'admin') {
            header("Location: ../admin/dashboard.php");
        } else {
            header("Location: ../index.php");
        }
        exit;   // ← PENTING!

    } else {
        $_SESSION['error'] = "Email/NIM atau Password salah!";
        header("Location: ../index.php");
        exit;
    }
} catch (Exception $e) {
    $_SESSION['error'] = "Terjadi kesalahan. Coba lagi.";
    header("Location: ../index.php");
    exit;
}
?>