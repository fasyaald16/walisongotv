<?php
session_start();

if (!isset($_SESSION['otp'])) {
    header("Location: forgot_password.php");
    exit;
}
?>

<h2>Reset Password</h2>

<form action="proses_reset.php" method="POST">
    <input type="text" name="otp" placeholder="Masukkan OTP" required>
    <input type="password" name="password" placeholder="Password Baru" required>
    <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required>
    <button type="submit">Reset Password</button>
</form>

<?php
if (isset($_SESSION['error'])) {
    echo "<script>alert('".$_SESSION['error']."');</script>";
    unset($_SESSION['error']);
}
?>