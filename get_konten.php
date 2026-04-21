<?php
include 'koneksi.php';
header('Content-Type: application/json');

$stmt = $pdo->query("SELECT * FROM konten ORDER BY tanggal_upload DESC");
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>