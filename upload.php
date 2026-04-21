<?php
include 'koneksi.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul     = $_POST['judul'];
    $kategori  = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'] ?? '';
    $durasi    = $_POST['durasi'] ?? '2:27:20';

    // Upload Thumbnail
    $thumb_path = '';
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
        $thumb_name = time() . '_' . $_FILES['thumbnail']['name'];
        $thumb_path = 'uploads/' . $thumb_name;
        move_uploaded_file($_FILES['thumbnail']['tmp_name'], $thumb_path);
    }

    // Upload Video
    $video_path = '';
    if (isset($_FILES['video']) && $_FILES['video']['error'] == 0) {
        $video_name = time() . '_' . $_FILES['video']['name'];
        $video_path = 'uploads/' . $video_name;
        move_upLoaded_file($_FILES['video']['tmp_name'], $video_path);
    }

    $stmt = $pdo->prepare("INSERT INTO konten (judul, kategori, deskripsi, thumbnail, video_url, durasi) 
                           VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$judul, $kategori, $deskripsi, $thumb_path, $video_path, $durasi]);

    echo json_encode(['status' => 'success', 'message' => 'Konten berhasil diupload!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
}
?>