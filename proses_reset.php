<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['otp'])) {
    header("Location: forgot_password.php");
    exit;
}

$input_otp = $_POST['otp'];
$password = $_POST['password'];
$confirm = $_POST['confirm_password'];

$email = $_SESSION['reset_email'];
$otp_session = $_SESSION['otp'];

// =======================
// VALIDASI OTP
// =======================
if ($input_otp != $otp_session) {
    $_SESSION['error'] = "OTP salah!";
    header("Location: reset_password.php");
    exit;
}

// =======================
// VALIDASI PASSWORD
// =======================
if ($password !== $confirm) {
    $_SESSION['error'] = "Konfirmasi password tidak sama!";
    header("Location: reset_password.php");
    exit;
}

if (strlen($password) < 6) {
    $_SESSION['error'] = "Password minimal 6 karakter!";
    header("Location: reset_password.php");
    exit;
}

// =======================
// UPDATE PASSWORD
// =======================
$new_password = password_hash($password, PASSWORD_DEFAULT);

mysqli_query($conn, "UPDATE users SET password='$new_password' WHERE email='$email'");

// hapus session
unset($_SESSION['otp']);
unset($_SESSION['reset_email']);

$_SESSION['success'] = "Password berhasil direset!";
header("Location: login.php");
exit;