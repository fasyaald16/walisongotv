<?php
session_start();
include '../koneksi.php';

$email = $_POST['email'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($query);

if ($user) {
    // generate OTP (6 digit)
    $otp = rand(100000, 999999);

    // simpan ke session
    $_SESSION['reset_email'] = $email;
    $_SESSION['otp'] = $otp;

    // 🔥 tampilkan OTP (khusus lokal)
    echo "<h3>OTP kamu: $otp</h3>";
    echo "<a href='reset_password.php'>Lanjut Reset Password</a>";

} else {
    $_SESSION['error'] = "Email tidak ditemukan!";
    header("Location: forgot_password.php");
    exit;
}