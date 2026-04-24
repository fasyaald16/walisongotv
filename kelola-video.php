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
    <title>Kelola Video - Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com/3.4.14"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-[#0A1428] text-white min-h-screen">

    <div class="max-w-7xl mx-auto p-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold">Kelola Video</h1>
                <p class="text-gray-400">Daftar semua video yang akan ditampilkan di website utama</p>
            </div>
            <a href="dashboard.php" class="text-[#5879AC] hover:underline">← Kembali ke Dashboard</a>
        </div>

        <a href="tambah-video.php" 
           class="inline-flex items-center gap-3 bg-[#5879AC] hover:bg-[#4A6A9C] px-8 py-4 rounded-3xl font-bold mb-8">
            <i class="fa-solid fa-plus"></i> Tambah Video Baru
        </a>

        <?php
        $stmt = $pdo->prepare("SELECT * FROM konten WHERE tipe = 'video' ORDER BY id DESC");
        $stmt->execute();
        $videos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <?php if (empty($videos)): ?>
            <div class="bg-[#1F2937] rounded-3xl p-16 text-center">
                <i class="fa-solid fa-video text-7xl mb-6 text-gray-500"></i>
                <p class="text-xl text-gray-400">Belum ada video yang ditambahkan</p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($videos as $video): ?>
                    <div class="bg-[#1F2937] rounded-3xl overflow-hidden group">
                        <div class="relative">
                            <img src="<?= htmlspecialchars($video['thumbnail'] ?? 'https://picsum.photos/id/1015/600/340') ?>" 
                                 class="w-full h-48 object-cover">
                            <div class="absolute bottom-2 right-2 bg-black/70 text-white text-xs px-3 py-1 rounded">
                                <?= htmlspecialchars($video['durasi'] ?? '-') ?>
                            </div>
                        </div>
                        <div class="p-5">
                            <h3 class="font-semibold leading-tight mb-3 line-clamp-2">
                                <?= htmlspecialchars($video['judul']) ?>
                            </h3>
                            <p class="text-xs text-gray-400 mb-4">
                                <?= htmlspecialchars($video['kategori']) ?> • ID: <?= $video['id'] ?>
                            </p>
                            
                            <div class="flex gap-2">
                                <button onclick="previewVideo(<?= $video['id'] ?>, '<?= htmlspecialchars($video['video_url']) ?>', '<?= addslashes($video['judul']) ?>')" 
                                        class="flex-1 bg-[#5879AC] hover:bg-[#4A6A9C] text-center py-3 rounded-2xl text-sm font-medium transition">
                                    ▶ Preview
                                </button>
                                <a href="edit-video.php?id=<?= $video['id'] ?>" 
                                   class="px-5 border border-gray-500 hover:bg-[#2A3749] rounded-2xl text-sm flex items-center justify-center">
                                    ✏
                                </a>
                                <button onclick="hapusVideo(<?= $video['id'] ?>, '<?= addslashes($video['judul']) ?>')" 
                                        class="px-5 border border-red-500 hover:bg-red-900 text-red-400 rounded-2xl text-sm flex items-center justify-center">
                                    🗑
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Modal Preview Video -->
    <div id="videoPreviewModal" class="video-modal hidden fixed inset-0 bg-black/95 z-[9999] flex items-center justify-center">
        <div class="video-container bg-[#1F2937] rounded-3xl max-w-4xl w-full mx-4 overflow-hidden">
            <div class="flex justify-between items-center px-6 py-4 border-b border-gray-700">
                <h3 id="modalVideoTitle" class="font-semibold text-lg"></h3>
                <button onclick="closeVideoModal()" class="text-3xl text-gray-400 hover:text-white">&times;</button>
            </div>
            <div class="aspect-video bg-black">
                <iframe id="previewIframe" width="100%" height="100%" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <script>
        function previewVideo(id, videoUrl, title) {
            document.getElementById('modalVideoTitle').textContent = title;
            let embedUrl = videoUrl;

            if (videoUrl.includes('watch?v=')) {
                const videoId = videoUrl.split('v=')[1].split('&')[0];
                embedUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
            } else if (videoUrl.includes('youtu.be/')) {
                const videoId = videoUrl.split('youtu.be/')[1].split('?')[0];
                embedUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
            }

            document.getElementById('previewIframe').src = embedUrl;
            document.getElementById('videoPreviewModal').classList.remove('hidden');
        }

        function closeVideoModal() {
            const modal = document.getElementById('videoPreviewModal');
            const iframe = document.getElementById('previewIframe');
            iframe.src = '';
            modal.classList.add('hidden');
        }

        function hapusVideo(id, judul) {
            if (confirm(`Yakin ingin menghapus video "${judul}"?\n\nTindakan ini tidak bisa dibatalkan!`)) {
                window.location.href = `proses-hapus-video.php?id=${id}`;
            }
        }
    </script>

</body>
</html>