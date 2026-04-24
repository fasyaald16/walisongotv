<?php
session_start();
?>

<h2>Lupa Password (OTP)</h2>

<form action="proses_forgot.php" method="POST">
    <input type="email" name="email" placeholder="Masukkan Email" required>
    <button type="submit">Kirim OTP</button>
</form>

<?php
if (isset($_SESSION['error'])) {
    echo "<script>alert('".$_SESSION['error']."');</script>";
    unset($_SESSION['error']);
}
?>