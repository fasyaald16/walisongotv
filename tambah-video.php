<?php
session_start();
require_once '../koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Video Baru - Admin</title>
    <script src="https://cdn.tailwindcss.com/3.4.14"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-[#0A1428] text-white min-h-screen">

    <div class="max-w-4xl mx-auto p-8">
        <div class="flex items-center gap-4 mb-8">
            <a href="kelola-video.php" class="text-[#5879AC] hover:underline">
                ← Kembali
            </a>
            <h1 class="text-3xl font-bold">Tambah Video Baru</h1>
        </div>

        <div class="bg-[#1F2937] rounded-3xl p-8">
            <form action="proses-video.php" method="POST" enctype="multipart/form-data">
                
                <div>
                    <label class="block text-sm font-medium mb-3">Judul Video</label>
                    <input type="text" name="judul" required
                           class="w-full bg-[#0A1428] border border-gray-600 rounded-2xl px-5 py-4 focus:outline-none focus:border-[#5879AC]">
                </div>

                <!-- Kategori Tab Beranda -->
                <div class="mt-8">
                    <label class="block text-sm font-medium mb-3">Kategori Tab Beranda</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="kategori_tab[]" value="Dakwah"> Dakwah
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="kategori_tab[]" value="Edukasi"> Edukasi
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="kategori_tab[]" value="Inspirasi"> Inspirasi
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="kategori_tab[]" value="Songo Minute"> Songo Minute
                        </label>
                    </div>
                </div>

                <!-- Kategori Halaman Cari -->
                <div class="mt-8">
                    <label class="block text-sm font-medium mb-3">Kategori Halaman Cari</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="kategori_cari[]" value="Sekitar Kita"> Sekitar Kita
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="kategori_cari[]" value="Tastory"> Tastory
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="kategori_cari[]" value="Reboost"> Reboost
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="kategori_cari[]" value="News"> News
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="kategori_cari[]" value="Film"> Film
                        </label>
                    </div>
                </div>

                <div class="mt-8">
                    <label class="block text-sm font-medium mb-2">Deskripsi Video</label>
                    <textarea name="deskripsi" rows="5" required
                              class="w-full bg-[#0A1428] border border-gray-600 rounded-3xl px-5 py-4 focus:outline-none focus:border-[#5879AC]"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                    <div>
                        <label class="block text-sm font-medium mb-2">Thumbnail (Gambar)</label>
                        <input type="file" name="thumbnail" accept="image/*" 
                            class="w-full bg-[#0A1428] border border-gray-600 rounded-2xl px-5 py-4">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">Durasi (contoh: 12:45)</label>
                        <input type="text" name="durasi" placeholder="12:45"
                               class="w-full bg-[#0A1428] border border-gray-600 rounded-2xl px-5 py-4">
                    </div>
                </div>

                <div class="mt-8">
                    <label class="block text-sm font-medium mb-2">Link Video YouTube</label>
                    <input type="url" name="video_url" placeholder="https://www.youtube.com/watch?v=..." required
                           class="w-full bg-[#0A1428] border border-gray-600 rounded-2xl px-5 py-4">
                </div>

                <div class="mt-10 flex gap-4">
                    <button type="submit" 
                            class="flex-1 bg-[#5879AC] hover:bg-[#4A6A9C] py-5 rounded-3xl font-bold text-lg">
                        Simpan Video
                    </button>
                    <a href="kelola-video.php" 
                       class="px-10 border border-gray-500 hover:bg-[#1F2937] py-5 rounded-3xl font-medium">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>