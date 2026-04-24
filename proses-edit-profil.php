<?php
session_start();
require_once 'koneksi.php';

header('Content-Type: text/plain');

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    echo "Anda harus login terlebih dahulu.";
    exit;
}

$id = (int)($_SESSION['id'] ?? 0);
if ($id <= 0) {
    echo "ID user tidak valid.";
    exit;
}

$nama          = trim($_POST['nama'] ?? '');
$nim           = trim($_POST['nim'] ?? '');
$gender        = trim($_POST['gender'] ?? '');
$tanggal_lahir = trim($_POST['tanggal_lahir'] ?? '');

// Upload Foto
$foto_baru = '';
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $target_dir = "uploads/profil/";
    if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

    $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
    $foto_baru = $target_dir . "user_" . $id . "_" . time() . "." . $ext;

    if (!move_uploaded_file($_FILES['foto']['tmp_name'], $foto_baru)) {
        $foto_baru = '';
    }
}

try {
    $sql = "UPDATE users SET nama_lengkap = ?, nim = ?";
    $params = [$nama, $nim];

    if ($foto_baru) {
        $sql .= ", photo = ?";
        $params[] = $foto_baru;
    }
    if ($gender !== '') {
        $sql .= ", gender = ?";
        $params[] = $gender;
    }
    if ($tanggal_lahir !== '') {
        $sql .= ", tanggal_lahir = ?";
        $params[] = $tanggal_lahir;
    }

    $sql .= " WHERE id = ?";
    $params[] = $id;

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    // Update Session
    $_SESSION['nama'] = $nama;
    if ($foto_baru) $_SESSION['photo'] = $foto_baru;

    echo "berhasil";

} catch (Exception $e) {
    echo "Gagal menyimpan: " . $e->getMessage();
}
?>