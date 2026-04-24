<?php
session_start();
require_once '../koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: tambah-video.php");
    exit;
}

$judul       = trim($_POST['judul'] ?? '');
$deskripsi   = trim($_POST['deskripsi'] ?? '');
$durasi      = trim($_POST['durasi'] ?? '');
$video_url   = trim($_POST['video_url'] ?? '');

$kategori_tab  = $_POST['kategori_tab'] ?? [];
$kategori_cari = $_POST['kategori_cari'] ?? [];
$all_categories = array_merge($kategori_tab, $kategori_cari);
$kategori_string = implode(', ', $all_categories);

if (empty($judul) || empty($deskripsi) || empty($video_url) || empty($all_categories)) {
    $_SESSION['error'] = "Judul, deskripsi, link video, dan minimal satu kategori harus diisi!";
    header("Location: tambah-video.php");
    exit;
}

// === UPLOAD THUMBNAIL ===
$thumbnail = 'default-thumbnail.jpg';

if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === 0) {
    $upload_dir = '../uploads/thumbnails/';
    
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $file_ext = strtolower(pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION));
    $allowed_ext = ['jpg', 'jpeg', 'png', 'webp'];

    if (in_array($file_ext, $allowed_ext)) {
        $new_filename = 'thumb_' . time() . '.' . $file_ext;
        $target_path = $upload_dir . $new_filename;

        if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target_path)) {
            $thumbnail = 'uploads/thumbnails/' . $new_filename;
        } else {
            $_SESSION['error'] = "Gagal mengupload thumbnail.";
        }
    } else {
        $_SESSION['error'] = "Format gambar tidak didukung. Gunakan jpg, jpeg, png, atau webp.";
    }
}

try {
    $stmt = $pdo->prepare("
        INSERT INTO konten 
        (judul, kategori, deskripsi, thumbnail, durasi, video_url, tipe) 
        VALUES (?, ?, ?, ?, ?, ?, 'video')
    ");

    $stmt->execute([
        $judul,
        $kategori_string,
        $deskripsi,
        $thumbnail,
        $durasi,
        $video_url
    ]);

    $_SESSION['success'] = "✅ Video berhasil ditambahkan!";
    header("Location: kelola-video.php");
    exit;

} catch (PDOException $e) {
    $_SESSION['error'] = "Gagal menyimpan video: " . $e->getMessage();
    header("Location: tambah-video.php");
    exit;
}
?>