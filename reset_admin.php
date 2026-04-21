<?php
include 'koneksi.php';

$email = 'admin@walisongo.tv';
$password_plain = '123456';
$hashed = password_hash($password_plain, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user) {
    // Update password yang sudah ada
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->execute([$hashed, $email]);
    echo "Password admin berhasil di-update!";
} else {
    // Buat akun admin baru
    $stmt = $pdo->prepare("INSERT INTO users (nama_lengkap, email, password, role) VALUES (?, ?, ?, 'admin')");
    $stmt->execute(['Administrator', $email, $hashed]);
    echo "Akun admin baru berhasil dibuat!";
}

echo "<br><br><a href='index.html'>Kembali ke Website</a>";
?>