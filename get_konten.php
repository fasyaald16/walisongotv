<?php
header('Content-Type: application/json');
require_once 'koneksi.php';

$kategori_filter = isset($_GET['kategori']) ? trim($_GET['kategori']) : '';

try {
    if (!empty($kategori_filter)) {
        $sql = "SELECT id, judul, thumbnail, durasi, video_url, kategori 
                FROM konten 
                WHERE tipe = 'video' 
                AND (kategori LIKE ? OR kategori LIKE ? OR kategori LIKE ?)
                ORDER BY id DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            "%" . $kategori_filter . "%",
            "%" . $kategori_filter . ",%",
            "%," . $kategori_filter . "%"
        ]);
    } else {
        $sql = "SELECT id, judul, thumbnail, durasi, video_url, kategori 
                FROM konten 
                WHERE tipe = 'video' 
                ORDER BY id DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);

} catch (Exception $e) {
    echo json_encode(['error' => true, 'message' => $e->getMessage()]);
}
?>