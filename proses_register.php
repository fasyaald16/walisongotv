<?php
session_start();
require_once '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama     = trim($_POST['nama'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $nim      = trim($_POST['nim'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($nama) || empty($email) || empty($password)) {
        echo "Nama, Email, dan Password wajib diisi!";
        exit;
    }

    // Cek email sudah terdaftar
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        echo "Email sudah terdaftar!";
        exit;
    }

    // Hash password
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (nama_lengkap, email, nim, password, role) 
                           VALUES (?, ?, ?, ?, 'user')");
    
    if ($stmt->execute([$nama, $email, $nim, $hash])) {
        echo "berhasil";
    } else {
        echo "Gagal mendaftarkan akun.";
    }

} else {
    echo "Metode tidak diizinkan.";
}
?>