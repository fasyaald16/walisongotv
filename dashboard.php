<?php
// admin/dashboard.php
session_start();
require_once '../koneksi.php';

// Paksa reload session
session_write_close();
session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Walisongo TV</title>
    <script src="https://cdn.tailwindcss.com/3.4.14"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-[#0A1428] text-white min-h-screen">

    <div class="max-w-6xl mx-auto p-10">
        <h1 class="text-5xl font-bold text-green-400 mb-2">Dashboard Admin</h1>
        <p class="text-xl text-gray-400 mb-8">Selamat datang, <?= htmlspecialchars($_SESSION['nama'] ?? 'Admin') ?></p>

        <div class="bg-[#1F2937] rounded-3xl p-8 mb-10">
            <h2 class="text-2xl font-semibold mb-6">Session Info (Debug):</h2>
            <pre class="bg-black p-6 rounded-2xl text-green-400 overflow-auto text-sm">
<?php print_r($_SESSION); ?>
            </pre>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="kelola-video.php" 
               class="bg-[#5879AC] hover:bg-[#4A6A9C] p-10 rounded-3xl text-center transition-all">
                <i class="fa-solid fa-video text-6xl mb-6"></i>
                <h3 class="text-2xl font-semibold">Kelola Video</h3>
                <p class="mt-3 text-sm opacity-90">Tambah, Edit, Hapus Video & Kategori</p>
            </a>
        </div>

        <div class="mt-12">
            <a href="../index.php" class="text-[#5879AC] hover:underline">← Kembali ke Website Utama</a>
        </div>
    </div>

</body>
</html>