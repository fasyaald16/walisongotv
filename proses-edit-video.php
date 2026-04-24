<?php
// admin/proses-edit-video.php
session_start();
require_once '../koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: kelola-video.php");
    exit;
}

$id          = (int)$_POST['id'];
$judul       = trim($_POST['judul'] ?? '');
$deskripsi   = trim($_POST['deskripsi'] ?? '');
$durasi      = trim($_POST['durasi'] ?? '');
$video_url   = trim($_POST['video_url'] ?? '');

$kategori_tab  = $_POST['kategori_tab'] ?? [];
$kategori_cari = $_POST['kategori_cari'] ?? [];

// Gabungkan semua kategori yang dipilih
$all_categories = array_merge($kategori_tab, $kategori_cari);
$kategori_string = implode(', ', $all_categories);

if ($id <= 0 || empty($judul) || empty($deskripsi) || empty($video_url) || empty($all_categories)) {
    $_SESSION['error'] = "Judul, deskripsi, link video, dan minimal satu kategori harus diisi!";
    header("Location: edit-video.php?id=$id");
    exit;
}

try {
    $stmt = $pdo->prepare("
        UPDATE konten 
        SET judul = ?, 
            kategori = ?, 
            deskripsi = ?, 
            durasi = ?, 
            video_url = ? 
        WHERE id = ? AND tipe = 'video'
    ");

    $stmt->execute([$judul, $kategori_string, $deskripsi, $durasi, $video_url, $id]);

    $_SESSION['success'] = "✅ Video berhasil diperbarui!";
    header("Location: kelola-video.php");
    exit;

} catch (PDOException $e) {
    $_SESSION['error'] = "Gagal memperbarui video: " . $e->getMessage();
    header("Location: edit-video.php?id=$id");
    exit;
}
?>