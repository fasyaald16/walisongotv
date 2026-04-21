<?php
session_start();

if (isset($_SESSION['error'])) {
    echo "<script>alert('".$_SESSION['error']."');</script>";
    unset($_SESSION['error']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
<form method="POST" action="proses_register.php" enctype="multipart/form-data">
  <input type="text" name="nim" placeholder="NIM" required>
  <input type="text" name="nama" placeholder="Nama Lengkap" required>
  <input type="email" name="email" placeholder="Email" required>

  <input type="file" name="photo" required>

  <input type="password" name="password" placeholder="Password" required>
  <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required>

  <button type="submit">Register</button>
</form>
</body>