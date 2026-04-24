<?php
// admin/proses-hapus-video.php
session_start();
require_once '../koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: kelola-video.php");
    exit;
}

$id = (int)$_GET['id'];

if ($id <= 0) {
    header("Location: kelola-video.php");
    exit;
}

try {
    // Cek apakah video benar-benar ada
    $stmt = $pdo->prepare("SELECT judul FROM konten WHERE id = ? AND tipe = 'video'");
    $stmt->execute([$id]);
    $video = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$video) {
        $_SESSION['error'] = "Video tidak ditemukan!";
        header("Location: kelola-video.php");
        exit;
    }

    // Hapus video
    $stmt = $pdo->prepare("DELETE FROM konten WHERE id = ? AND tipe = 'video'");
    $stmt->execute([$id]);

    $_SESSION['success'] = "✅ Video \"" . htmlspecialchars($video['judul']) . "\" berhasil dihapus!";
    header("Location: kelola-video.php");
    exit;

} catch (PDOException $e) {
    $_SESSION['error'] = "Gagal menghapus video: " . $e->getMessage();
    header("Location: kelola-video.php");
    exit;
}
?>