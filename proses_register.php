<?php
// proses_register.php - Versi Diperbaiki untuk AJAX

session_start();
include 'koneksi.php';

header('Content-Type: application/json');

try {
    $nim = trim($_POST['nim'] ?? '');
    $nama = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validasi
    if (empty($nim) || empty($nama) || empty($email) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'Semua field wajib diisi']);
        exit;
    }

    if ($password !== $confirm_password) {
        echo json_encode(['status' => 'error', 'message' => 'Konfirmasi password tidak cocok']);
        exit;
    }

    if (strlen($password) < 6) {
        echo json_encode(['status' => 'error', 'message' => 'Password minimal 6 karakter']);
        exit;
    }

    if (!is_numeric($nim) || strlen($nim) != 10) {
        echo json_encode(['status' => 'error', 'message' => 'NIM harus 10 digit angka']);
        exit;
    }

    // Cek duplikat
    $stmt = $pdo->prepare("SELECT id FROM users WHERE nim = ? OR email = ?");
    $stmt->execute([$nim, $email]);
    if ($stmt->fetch()) {
        echo json_encode(['status' => 'error', 'message' => 'NIM atau Email sudah terdaftar']);
        exit;
    }

    // Upload Foto
    $foto = null;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $target_dir = "assets/images/users/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

        $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png'];

        if (!in_array($ext, $allowed)) {
            echo json_encode(['status' => 'error', 'message' => 'Format foto harus JPG, JPEG, atau PNG']);
            exit;
        }

        $foto = time() . "_" . basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], $target_dir . $foto);
    }

    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (nim, nama_lengkap, email, photo, password, role) 
                           VALUES (?, ?, ?, ?, ?, 'user')");
    $success = $stmt->execute([$nim, $nama, $email, $foto, $hashed]);

    if ($success) {
        echo json_encode(['status' => 'success', 'message' => 'Registrasi berhasil! Silakan login.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data ke database']);
    }

} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error sistem: ' . $e->getMessage()]);
}
?>