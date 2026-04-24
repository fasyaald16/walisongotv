<?php
// index.php - Walisongo TV (Versi Diperbaiki)
session_start();

$is_logged_in = isset($_SESSION['login']) && $_SESSION['login'] === true;

$currentUser = $is_logged_in ? [
    'nama'  => $_SESSION['nama'] ?? 'User',
    'email' => $_SESSION['email'] ?? '',
    'foto'  => $_SESSION['photo'] ?? ''
] : null;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Walisongo TV</title>
    <script src="https://cdn.tailwindcss.com/3.4.14"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body {
            background: #0A1428;
            color: white;
            font-family: 'Inter', sans-serif;
        }
        .hero-bg {
            background: linear-gradient(rgba(10,20,40,0.55), #0A1428), url('bg2.png') center/cover;
        }
        .card-hover:hover {
            transform: scale(1.05);
            transition: all 0.3s;
        }
        .accent { color: #5879AC; }
    </style>
</head>
<body class="min-h-screen pb-20">

    <!-- NAVIGASI -->
    <nav class="bg-[#0A1428] border-b border-[#1F2937] px-6 py-4 sticky top-0 z-50">
        <div class="max-w-screen-2xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-3">
                <img src="logo jadi.png" alt="Walisongo TV" class="h-16 w-auto">
                <h1 class="text-2xl font-bold accent">Walisongo TV</h1>
            </div>
            <div class="hidden md:flex gap-8 text-sm font-medium">
                <a onclick="navigateTo('home')" class="cursor-pointer hover:text-[#5879AC]">Beranda</a>
                <a onclick="navigateTo('search')" class="cursor-pointer hover:text-[#5879AC]">Cari</a>
                <a onclick="navigateTo('live')" class="cursor-pointer hover:text-[#5879AC]">Siaran Langsung</a>
                <a onclick="navigateTo('favorites')" class="cursor-pointer hover:text-[#5879AC]">Favorit</a>
                <a onclick="navigateTo('profile')" class="cursor-pointer hover:text-[#5879AC]">Profil</a>
            </div>
            <button id="auth-btn" 
                    class="px-6 py-2.5 border border-[#5879AC] rounded-3xl hover:bg-[#5879AC] hover:text-white transition-all">
                Login
            </button>
        </div>
    </nav>

    <!-- ==================== BERANDA ==================== -->
    <div id="page-home" class="page">
        <!-- HERO SECTION -->
        <div class="hero-bg h-[520px] flex items-end px-8 pb-12">
            <div class="max-w-2xl">
                <div class="flex items-center gap-3 mb-3">
                    <span class="bg-[#5879AC] text-white text-xs px-4 py-1 rounded-full">Sekitar Kita:</span>
                </div>
                <h1 class="text-6xl font-bold leading-none">Broadcast?</h1>
                <p class="mt-4 text-xl">Siapa Takut</p>
                
                <!-- Button -->
                <button onclick="playFeatured()" 
                        class="mt-8 px-10 py-4 bg-white text-[#0A1428] rounded-3xl font-bold flex items-center gap-3 hover:bg-[#5879AC] hover:text-white transition-all">
                    <i class="fa-solid fa-play"></i> 
                    Tonton Sekarang
                </button>
            </div>
        </div>

        <div class="px-8 py-8">
            <h2 class="text-2xl font-semibold mb-4 accent">Lanjutkan Menonton</h2>
            <div id="continue-grid" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6"></div>
        </div>

        <div class="px-8 pb-6">
            <div class="flex gap-3 overflow-x-auto pb-4">
                <button onclick="showCategoryPage('Dakwah')" class="px-7 py-2 bg-[#1F2937] rounded-3xl whitespace-nowrap">Dakwah</button>
                <button onclick="showCategoryPage('Edukasi')" class="px-7 py-2 bg-[#1F2937] rounded-3xl whitespace-nowrap">Edukasi</button>
                <button onclick="showCategoryPage('Inspirasi')" class="px-7 py-2 bg-[#1F2937] rounded-3xl whitespace-nowrap">Inspirasi</button>
                <button onclick="showCategoryPage('Songo Minute')" class="px-7 py-2 bg-[#1F2937] rounded-3xl whitespace-nowrap">Songo Minute</button>
            </div>
        </div>

        <!-- Sudut Baca tetap sama -->
        <div class="px-8 py-8">
            <h2 class="text-2xl font-semibold mb-4 accent">Sudut Baca Walisongo</h2>
            <div class="swipe-container flex gap-6 overflow-x-auto pb-6 snap-x snap-mandatory">
                <!-- Card Sudut Baca kamu tetap sama, saya tidak ubah -->
                <div class="min-w-[300px] bg-[#1F2937] rounded-3xl overflow-hidden cursor-pointer card-hover snap-start flex flex-col">
                    <img src="Sudutbaca1.jpeg" class="w-full h-44 object-cover">
                    <div class="p-4 flex-1 flex flex-col">
                        <h3 class="font-semibold mb-4">GenBI UIN Walisongo Semarang Sukses Gelar Sosialisasi Beasiswa & Talkshow Personal Branding</h3>
                        <div class="mt-auto">
                            <a href="https://walisongo.ac.id/genbi-uin-walisongo-semarang-sukses-gelar-sosialisasi-beasiswa-dan-talkshow-personal-branding/" target="_blank" class="inline-flex items-center gap-2 text-[#5879AC] hover:text-white text-sm font-medium">
                                Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="min-w-[300px] bg-[#1F2937] rounded-3xl overflow-hidden cursor-pointer card-hover snap-start flex flex-col">
                    <img src="sb3.jpg" class="w-full h-44 object-cover">
                    <div class="p-4 flex-1 flex flex-col">
                        <h3 class="font-semibold mb-4">Rektor UIN Walisongo Dorong Kepemimpinan Responsif dan Berintegritas di Level Middle Management</h3>
                        <div class="mt-auto">
                            <a href="https://walisongo.ac.id/rektor-uin-walisongo-dorong-kepemimpinan-responsif-dan-berintegritas-di-level-middle-management/" target="_blank" class="inline-flex items-center gap-2 text-[#5879AC] hover:text-white text-sm font-medium">
                                Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="min-w-[300px] bg-[#1F2937] rounded-3xl overflow-hidden cursor-pointer card-hover snap-start flex flex-col">
                    <img src="sb2.jpg" class="w-full h-44 object-cover">
                    <div class="p-4 flex-1 flex flex-col">
                        <h3 class="font-semibold mb-4">Sukses Rekam Hilal, Tim Rukyat Planetarium dan Observatorium UIN Walisongo Berhasil Amati Hilal 29 Syawal 1447 H</h3>
                        <div class="mt-auto">
                            <a href="https://walisongo.ac.id/sukses-rekam-hilal-tim-rukyat-planetarium-dan-observatorium-uin-walisongo-berhasil-amati-hilal-29-syawal-1447-h/" target="_blank" class="inline-flex items-center gap-2 text-[#5879AC] hover:text-white text-sm font-medium">
                                Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card 2 & 3 tetap sama seperti kode kamu -->
                <!-- ... (saya singkat karena panjang) ... -->
            </div>
        </div>

        <!-- TAYANGAN TERBARU -->
        <div class="px-8 pb-12">
            <h2 class="text-2xl font-semibold mb-4 accent">Tayangan Terbaru</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6" id="poster-grid"></div>
        </div>
    </div>

    <!-- PAGE CARI -->
    <div id="page-search" class="page hidden px-8 py-8">
        <h1 class="text-3xl font-bold mb-6">Cari Konten</h1>
        
    <!-- Search Bar -->
        <div class="relative mb-8">
            <input 
                type="text" 
                id="search-input"
                placeholder="Cari judul video..." 
                class="w-full bg-[#1F2937] border border-gray-600 rounded-3xl px-6 py-4 pl-12 text-white focus:outline-none focus:border-[#5879AC] text-lg"
                onkeyup="searchVideos(this.value)">
            <i class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 text-xl"></i>
        </div>

        <!-- Kategori Cards -->
        <h2 class="text-xl font-semibold mb-4 text-gray-400">Pilih Kategori</h2>
        <div id="search-category-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6"></div>

        <!-- Hasil Pencarian -->
        <div id="search-results" class="hidden mt-10">
            <h2 class="text-xl font-semibold mb-4 accent">Hasil Pencarian</h2>
            <div id="results-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"></div>
        </div>
    </div>

        <!-- PAGE SIARAN LANGSUNG -->
    <div id="page-live" class="page hidden px-8 py-8">
        <div class="max-w-5xl mx-auto">
            <h1 class="text-4xl font-bold mb-3">Siaran Langsung</h1>
            <p class="text-gray-400 mb-12">Tonton acara live dari Walisongo TV</p>

            <!-- LIVE CARD -->
            <div class="bg-[#1F2937] rounded-3xl overflow-hidden">
                <div class="relative">
                    <!-- YouTube Video Embed -->
                    <div class="aspect-video bg-black">
                        <iframe id="live-iframe" 
                                width="100%" 
                                height="100%" 
                                src="https://www.youtube.com/embed/aoAMH07nwHw" 
                                title="Walisongo TV Live" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                        </iframe>
                    </div>

                    <!-- LIVE Indicator -->
                    <div class="absolute top-6 left-6 bg-red-600 text-white font-bold px-5 py-2 rounded-full flex items-center gap-2 shadow-xl z-10">
                        <div class="w-4 h-4 bg-white rounded-full animate-pulse"></div>
                        SEDANG LIVE
                    </div>
                </div>

                <div class="p-10">
                    <h2 class="text-3xl font-semibold mb-4">Walisongo TV Live</h2>
                    <p class="text-gray-300 text-lg mb-10">
                        Live Recording | Talkshow Sekitar Kita &amp; Ngapain aja sih KKN di Papua?
                    </p>

                    <button onclick="toggleLive()" 
                            id="live-button"
                            class="w-full md:w-auto bg-red-600 hover:bg-red-700 transition-all px-12 py-6 rounded-3xl text-2xl font-bold flex items-center justify-center gap-4 mx-auto">
                        <i class="fa-solid fa-play"></i>
                        TONTON SEKARANG
                    </button>
                </div>
            </div>

            <div class="text-center text-gray-500 mt-10 text-sm">
                Siaran live akan otomatis berjalan saat acara dimulai
            </div>
        </div>
    </div>

    <!-- PAGE FAVORIT -->
    <div id="page-favorites" class="page hidden px-8 py-8">
        <h1 class="text-3xl font-bold mb-8">Favorit Saya</h1>
        <div id="favorites-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"></div>
    </div>
    
    <!-- PAGE PROFIL -->
        <!-- PAGE PROFIL -->
    <div id="page-profile" class="page hidden px-8 py-12">
        <div class="max-w-5xl mx-auto">   <!-- Container tengah -->
            
            <?php if ($is_logged_in): ?>
                <div class="max-w-2xl mx-auto">   <!-- Konten di tengah -->

                    <!-- Foto + Nama -->
                    <div class="flex items-center gap-5 mb-10">
                        <div class="relative flex-shrink-0">
                            <img src="<?= htmlspecialchars($currentUser['foto'] ?? 'https://picsum.photos/id/64/150/150') ?>" 
                                 alt="Foto Profil" 
                                 class="w-28 h-28 rounded-full object-cover border-4 border-[#5879AC]"
                                 onerror="this.src='https://picsum.photos/id/64/150/150';">
                            
                            <!-- Tombol Edit yang sekarang berfungsi -->
                            <button onclick="showEditProfileModal()" 
                                    class="absolute -bottom-1 -right-1 bg-[#5879AC] hover:bg-white hover:text-[#5879AC] w-8 h-8 rounded-full flex items-center justify-center shadow border-2 border-[#0A1428]">
                                <i class="fa-solid fa-pencil text-sm"></i>
                            </button>
                        </div>
                        
                        <div>
                            <h1 class="text-3xl font-bold"><?= htmlspecialchars($currentUser['nama']) ?></h1>
                            <p class="text-gray-400"><?= htmlspecialchars($currentUser['email'] ?? '') ?></p>
                        </div>
                    </div>

                    <!-- Menu Kotak Panjang -->
                    <div class="space-y-3">
                        <div onclick="showRiwayat()" class="bg-[#1F2937] hover:bg-[#2A3749] p-5 rounded-3xl flex items-center gap-4 cursor-pointer transition-all w-full">
                            <i class="fa-solid fa-clock-rotate-left text-2xl w-10 text-[#5879AC]"></i>
                            <h3 class="font-semibold">Riwayat Tontonan</h3>
                        </div>
                        <div onclick="showDownload()" class="bg-[#1F2937] hover:bg-[#2A3749] p-5 rounded-3xl flex items-center gap-4 cursor-pointer transition-all w-full">
                            <i class="fa-solid fa-download text-2xl w-10 text-[#5879AC]"></i>
                            <h3 class="font-semibold">Download Saya</h3>
                        </div>
                        <div onclick="showTentang()" class="bg-[#1F2937] hover:bg-[#2A3749] p-5 rounded-3xl flex items-center gap-4 cursor-pointer transition-all w-full">
                            <i class="fa-solid fa-info-circle text-2xl w-10 text-[#5879AC]"></i>
                            <h3 class="font-semibold">Tentang Walisongo TV</h3>
                        </div>
                        <div onclick="showKeamanan()" class="bg-[#1F2937] hover:bg-[#2A3749] p-5 rounded-3xl flex items-center gap-4 cursor-pointer transition-all w-full">
                            <i class="fa-solid fa-shield-halved text-2xl w-10 text-[#5879AC]"></i>
                            <h3 class="font-semibold">Keamanan</h3>
                        </div>
                        <div onclick="logoutUser()" class="bg-red-600 hover:bg-red-700 p-5 rounded-3xl flex items-center gap-4 cursor-pointer transition-all w-full">
                            <i class="fa-solid fa-right-from-bracket text-2xl w-10"></i>
                            <h3 class="font-semibold">Keluar</h3>
                        </div>
                    </div>

                </div>
            <?php endif; ?>

        </div>
    </div>

    <!-- PAGE KATEGORI -->
    <div id="page-kategori" class="page hidden px-8 py-8">
        <button onclick="backToHome()" class="mb-6 text-3xl"><i class="fa-solid fa-arrow-left"></i></button>
        <h1 id="kategori-title" class="text-4xl font-bold mb-8"></h1>
        <div id="kategori-content-grid" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6"></div>
    </div>

        <!-- MODAL LOGIN -->
    <div id="login-modal" class="hidden fixed inset-0 bg-black/80 flex items-center justify-center z-[100]">
        <div class="bg-[#1F2937] rounded-3xl w-full max-w-md p-8 relative">
            <h2 class="text-2xl font-bold text-center mb-8">Masuk ke Akun</h2>
            
            <form id="login-form" class="space-y-5">
                <input type="text" id="login-identity" placeholder="Email atau NIM" 
                       class="w-full bg-[#0A1428] border border-gray-600 rounded-2xl px-5 py-4 focus:outline-none focus:border-[#5879AC]">
                
                <input type="password" id="login-password" placeholder="Password" 
                       class="w-full bg-[#0A1428] border border-gray-600 rounded-2xl px-5 py-4 focus:outline-none focus:border-[#5879AC]">
                
                <button type="submit" 
                        class="w-full bg-[#5879AC] hover:bg-[#4A6A9C] py-4 rounded-2xl font-bold text-lg">
                    MASUK
                </button>
            </form>

            <div class="text-center mt-6">
                <button onclick="showRegisterModal()" class="text-[#5879AC] hover:underline">
                    Belum punya akun? Daftar sekarang
                </button>
            </div>

            <button onclick="hideLoginModal()" 
                    class="absolute top-4 right-4 text-3xl text-gray-400 hover:text-white">✕</button>
        </div>
    </div>

    <!-- MODAL REGISTER -->
    <div id="register-modal" class="hidden fixed inset-0 bg-black/80 flex items-center justify-center z-[100]">
        <div class="bg-[#1F2937] rounded-3xl w-full max-w-md p-8 relative">
            <h2 class="text-2xl font-bold text-center mb-8">Buat Akun Baru</h2>
            
            <form id="register-form" class="space-y-5">
                <input type="text" id="reg-nama" placeholder="Nama Lengkap" required
                       class="w-full bg-[#0A1428] border border-gray-600 rounded-2xl px-5 py-4">
                <input type="email" id="reg-email" placeholder="Email" required
                       class="w-full bg-[#0A1428] border border-gray-600 rounded-2xl px-5 py-4">
                <input type="text" id="reg-nim" placeholder="NIM (jika mahasiswa)" 
                       class="w-full bg-[#0A1428] border border-gray-600 rounded-2xl px-5 py-4">
                <input type="password" id="reg-password" placeholder="Password" required
                       class="w-full bg-[#0A1428] border border-gray-600 rounded-2xl px-5 py-4">
                
                <button type="submit" 
                        class="w-full bg-[#5879AC] hover:bg-[#4A6A9C] py-4 rounded-2xl font-bold text-lg">
                    DAFTAR
                </button>
            </form>

            <div class="text-center mt-6">
                <button onclick="showLoginModal()" class="text-[#5879AC] hover:underline">
                    Sudah punya akun? Login
                </button>
            </div>

            <button onclick="hideRegisterModal()" 
                    class="absolute top-4 right-4 text-3xl text-gray-400 hover:text-white">✕</button>
        </div>
    </div>

            <!-- ==================== MODAL EDIT PROFIL ==================== -->
    <div id="edit-profile-modal" class="hidden fixed inset-0 bg-black/80 flex items-center justify-center z-[110] p-4">
        <div class="bg-[#1F2937] rounded-3xl w-full max-w-lg max-h-[90vh] overflow-y-auto relative">
            
            <div class="p-8">
                <h2 class="text-2xl font-bold text-center mb-8">Edit Profil</h2>
                
                <form id="edit-profile-form" enctype="multipart/form-data">
                    <!-- Foto -->
                    <div class="flex flex-col items-center mb-6">
                        <img id="preview-foto" src="<?= htmlspecialchars($currentUser['foto'] ?? 'https://picsum.photos/id/64/150/150') ?>" 
                             class="w-28 h-28 rounded-full object-cover border-4 border-[#5879AC] mb-4">
                        <label class="cursor-pointer bg-[#5879AC] hover:bg-[#4A6A9C] px-6 py-3 rounded-2xl text-sm font-medium">
                            Ganti Foto Profil
                            <input type="file" id="foto" name="foto" accept="image/*" class="hidden" onchange="previewImage(event)">
                        </label>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm mb-2">Nama Lengkap</label>
                            <input type="text" id="edit-nama" name="nama" 
                                   value="<?= htmlspecialchars($currentUser['nama'] ?? '') ?>" 
                                   class="w-full bg-[#0A1428] border border-gray-600 rounded-2xl px-5 py-4">
                        </div>

                        <div>
                            <label class="block text-sm mb-2">Email <span class="text-red-400">(tidak dapat diubah)</span></label>
                            <input type="email" value="<?= htmlspecialchars($currentUser['email'] ?? '') ?>" 
                                   class="w-full bg-[#0A1428] border border-gray-600 rounded-2xl px-5 py-4 text-gray-400" readonly>
                        </div>

                        <div>
                            <label class="block text-sm mb-2">NIM (Opsional)</label>
                            <input type="text" id="edit-nim" name="nim" 
                                   value="<?= htmlspecialchars($currentUser['nim'] ?? '') ?>" 
                                   class="w-full bg-[#0A1428] border border-gray-600 rounded-2xl px-5 py-4">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm mb-2">Gender</label>
                                <select id="edit-gender" name="gender" class="w-full bg-[#0A1428] border border-gray-600 rounded-2xl px-5 py-4">
                                    <option value="">Pilih Gender</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm mb-2">Tanggal Lahir</label>
                                <input type="date" id="edit-tanggal_lahir" name="tanggal_lahir" 
                                       class="w-full bg-[#0A1428] border border-gray-600 rounded-2xl px-5 py-4">
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-4 mt-10">
                        <button type="button" onclick="hideEditProfileModal()" 
                                class="flex-1 py-4 rounded-2xl border border-gray-500 hover:bg-[#2A3749]">
                            Batal
                        </button>
                        <button type="submit" 
                                class="flex-1 bg-[#5879AC] hover:bg-[#4A6A9C] py-4 rounded-2xl font-bold">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Close Button -->
            <button onclick="hideEditProfileModal()" 
                    class="absolute top-4 right-4 text-3xl text-gray-400 hover:text-white">✕</button>
        </div>
    </div>

    <!-- Halaman lain tetap sama (Favorites, Live, Profile, Modals) -->
    <!-- ... (saya tidak ubah bagian ini agar UI kamu tetap sama) ... -->

       <script>
        let currentUser = <?php echo json_encode($currentUser); ?>;
        let allKonten = [];

        // ==================== FUNGSI KATEGORI (SUDAH STABIL) ====================
        function showCategoryPage(kategori) {
            navigateTo('kategori');
            document.getElementById('kategori-title').innerText = kategori;

            const container = document.getElementById('kategori-content-grid');
            if (!container) return;

            container.innerHTML = `
                <div class="col-span-full py-12 text-center">
                    <div class="animate-spin w-8 h-8 border-4 border-[#5879AC] border-t-transparent rounded-full mx-auto mb-4"></div>
                    <p class="text-gray-400">Memuat ${kategori}...</p>
                </div>
            `;

            fetch(`get_konten.php?kategori=${encodeURIComponent(kategori)}`)
                .then(r => r.json())
                .then(data => {
                    container.innerHTML = '';
                    if (!Array.isArray(data) || data.length === 0) {
                        container.innerHTML = `<p class="text-gray-400 text-center py-12">Belum ada video di kategori "${kategori}".</p>`;
                        return;
                    }

                    data.forEach(item => {
                        const div = document.createElement('div');
                        div.className = 'bg-[#1F2937] rounded-3xl overflow-hidden cursor-pointer card-hover group';

                        div.innerHTML = `
                            <div class="relative">
                                <img src="${item.thumbnail || 'https://picsum.photos/id/1015/600/340'}" 
                                     class="w-full aspect-video object-cover">
                                <div class="absolute bottom-2 right-2 bg-black/70 text-white text-xs px-2 py-1 rounded">
                                    ${item.durasi || '00:00'}
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-sm leading-tight line-clamp-2 mb-3 group-hover:text-[#5879AC]">
                                    ${item.judul}
                                </h3>
                                <div class="text-[#5879AC] text-sm flex items-center gap-2">
                                    Tonton Video <i class="fa-solid fa-arrow-right"></i>
                                </div>
                            </div>
                        `;

                        div.onclick = () => window.location.href = `video-detail.php?id=${item.id}`;
                        container.appendChild(div);
                    });
                })
                .catch(err => {
                    console.error(err);
                    container.innerHTML = `<p class="text-red-400 text-center py-12">Gagal memuat kategori ${kategori}.</p>`;
                });
        }

        // Halaman Cari
        const cariKategori = ["Sekitar Kita", "Tastory", "Reboost", "Film", "News"];
        function renderCariKategori() {
            const container = document.getElementById('search-category-grid');
            if (!container) return;
            container.innerHTML = '';
            
            cariKategori.forEach(kat => {
                const div = document.createElement('div');
                div.className = 'bg-[#1F2937] p-8 rounded-3xl text-center cursor-pointer card-hover hover:bg-[#5879AC] transition-all';
                div.innerHTML = `<h3 class="text-xl font-semibold">${kat}</h3>`;
                div.onclick = () => showCategoryPage(kat);
                container.appendChild(div);
            });
        }

        // Tayangan Terbaru
        function renderPosterGrid() {
            const container = document.getElementById('poster-grid');
            if (!container) return;

            container.innerHTML = `
                <div class="col-span-3 py-12 text-center">
                    <div class="animate-spin w-8 h-8 border-4 border-[#5879AC] border-t-transparent rounded-full mx-auto mb-4"></div>
                    <p class="text-gray-400">Memuat Tayangan Terbaru...</p>
                </div>
            `;

            fetch('get_konten.php')
                .then(r => r.json())
                .then(data => {
                    container.innerHTML = '';
                    if (!Array.isArray(data) || data.length === 0) {
                        container.innerHTML = `<p class="col-span-3 text-gray-400 text-center py-12">Belum ada tayangan terbaru.</p>`;
                        return;
                    }

                    data.forEach(item => {
                        const div = document.createElement('div');
                        div.className = 'bg-[#1F2937] rounded-3xl overflow-hidden cursor-pointer card-hover group';
                        div.innerHTML = `
                            <div class="relative">
                                <img src="${item.thumbnail || 'https://picsum.photos/id/1015/600/340'}" class="w-full aspect-video object-cover">
                                <div class="absolute bottom-2 right-2 bg-black/70 text-white text-xs px-2 py-1 rounded">
                                    ${item.durasi || '00:00'}
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-sm leading-tight line-clamp-2 mb-3 group-hover:text-[#5879AC]">
                                    ${item.judul}
                                </h3>
                                <div class="text-[#5879AC] text-sm flex items-center gap-2">
                                    Tonton Video <i class="fa-solid fa-arrow-right"></i>
                                </div>
                            </div>
                        `;
                        div.onclick = () => window.location.href = `video-detail.php?id=${item.id}`;
                        container.appendChild(div);
                    });
                })
                .catch(err => console.error("Gagal load poster grid:", err));
        }

        // Navigasi sederhana
        function navigateTo(page) {
            document.querySelectorAll('.page').forEach(p => p.classList.add('hidden'));
            
            const target = document.getElementById('page-' + page);
            if (target) {
                target.classList.remove('hidden');
            } else {
                console.warn(`Halaman ${page} tidak ditemukan`);
            }
        }

        function backToHome() {
            navigateTo('home');
        }

        // ==================== FUNGSI LOGIN MODAL ====================
        function showLoginModal() {
            // Jika modal belum dibuat, buat dulu sementara
            let modal = document.getElementById('login-modal');
            if (!modal) {
                alert("Modal login belum dibuat. Silakan buat modal login terlebih dahulu.");
                return;
            }
            modal.classList.remove('hidden');
        }

        // ==================== RENDER PROFILE (LOGIN BUTTON) ====================
        function renderProfile() {
            const btn = document.getElementById('auth-btn');
            if (!btn) {
                console.error("Button #auth-btn tidak ditemukan!");
                return;
            }

            const isLoggedIn = <?php echo isset($_SESSION['login']) && $_SESSION['login'] === true ? 'true' : 'false'; ?>;

            if (isLoggedIn) {
                btn.textContent = 'Logout';
                btn.onclick = () => {
                    if (confirm('Keluar dari akun?')) {
                        window.location.href = 'auth/proses_logout.php';
                    }
                };
            } else {
                btn.textContent = 'Login';
                btn.onclick = function() {
                    console.log("✅ Button Login diklik");
                    showLoginModal();
                };
            }
        }

                // Login Form
        document.getElementById('login-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const identity = document.getElementById('login-identity').value.trim();
            const password = document.getElementById('login-password').value.trim();

            if (!identity || !password) {
                alert("Email/NIM dan Password harus diisi!");
                return;
            }

            try {
                const res = await fetch('auth/proses_login.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `identity=${encodeURIComponent(identity)}&password=${encodeURIComponent(password)}`
                });

                const text = await res.text();

                if (text.includes("berhasil") || res.ok) {
                    alert("✅ Login berhasil!");
                    window.location.reload();   // Refresh halaman supaya profil berubah
                } else {
                    alert("❌ Login gagal: " + text);
                }
            } catch (err) {
                console.error(err);
                alert("Terjadi kesalahan saat login.");
            }
        });

        // Register Form (sama seperti login)
        // ==================== REGISTER FORM ====================
        document.getElementById('register-form').addEventListener('submit', async function(e) {
            e.preventDefault();

            const nama     = document.getElementById('reg-nama').value.trim();
            const email    = document.getElementById('reg-email').value.trim();
            const nim      = document.getElementById('reg-nim').value.trim();
            const password = document.getElementById('reg-password').value.trim();

            if (!nama || !email || !password) {
                alert("Nama, Email, dan Password wajib diisi!");
                return;
            }

            const formData = new FormData();
            formData.append('nama', nama);
            formData.append('email', email);
            formData.append('nim', nim);
            formData.append('password', password);

            try {
                const res = await fetch('auth/proses_register.php', {
                    method: 'POST',
                    body: formData
                });

                const text = await res.text();

                if (text.includes("berhasil") || res.ok) {
                    alert("✅ Registrasi berhasil! Silakan login.");
                    hideRegisterModal();
                    showLoginModal();   // Otomatis buka modal login
                } else {
                    alert("❌ Registrasi gagal:\n" + text);
                }
            } catch (err) {
                console.error(err);
                alert("Terjadi kesalahan saat registrasi.");
            }
        });

        function hideLoginModal() {
            document.getElementById('login-modal').classList.add('hidden');
        }

        function hideRegisterModal() {
            document.getElementById('register-modal').classList.add('hidden');
        }

        function showRegisterModal() {
            hideLoginModal();
            document.getElementById('register-modal').classList.remove('hidden');
        }

        function showLoginModal() {
            hideRegisterModal();
            document.getElementById('login-modal').classList.remove('hidden');
        }

        function logoutUser() {
            if (confirm('Yakin ingin keluar dari akun?')) {
                window.location.href = 'auth/proses_logout.php';
            }
        }

        function editProfile() {
            alert("✏️ Fitur Edit Profil sedang dalam pengembangan.");
        }

        function showKeamanan() {
            alert("🔒 Keamanan Akun - Fitur sedang dikembangkan");
        }
        
        // Fungsi terpisah agar tidak tertimpa
        function handleLoginClick(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            console.log("✅ Button Login diklik - Membuka modal");
            
            if (typeof showLoginModal === 'function') {
                showLoginModal();
            } else {
                alert("Modal login belum dibuat. Buat dulu modal login ya.");
            }
        }

        // Fitur Pencarian Teks
        function searchVideos(query) {
            const resultsContainer = document.getElementById('results-grid');
            const resultsSection = document.getElementById('search-results');
            const categorySection = document.getElementById('search-category-grid');

            query = query.trim();

            if (query === '') {
                resultsSection.classList.add('hidden');
                categorySection.classList.remove('hidden');
                return;
            }

            categorySection.classList.add('hidden');
            resultsSection.classList.remove('hidden');

            // Pencarian lebih longgar (tidak peduli huruf besar/kecil, spasi ekstra)
            const filtered = allKonten.filter(item => 
                item.judul.toLowerCase().includes(query.toLowerCase())
            );

            resultsContainer.innerHTML = '';

            if (filtered.length === 0) {
                resultsContainer.innerHTML = `<p class="col-span-full text-gray-400 text-center py-12">Tidak ditemukan video dengan kata "${query}"</p>`;
                return;
            }

            filtered.forEach(item => {
                const div = document.createElement('div');
                div.className = 'bg-[#1F2937] rounded-3xl overflow-hidden cursor-pointer card-hover group';

                div.innerHTML = `
                    <div class="relative">
                        <img src="${item.thumbnail || 'https://picsum.photos/id/1015/600/340'}" 
                             class="w-full aspect-video object-cover">
                        <div class="absolute bottom-2 right-2 bg-black/70 text-white text-xs px-2 py-1 rounded">
                            ${item.durasi || '00:00'}
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-sm leading-tight line-clamp-2 mb-3 group-hover:text-[#5879AC]">
                            ${item.judul}
                        </h3>
                        <div class="text-[#5879AC] text-sm flex items-center gap-2">
                            Tonton Video <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>
                `;

                div.onclick = () => window.location.href = `video-detail.php?id=${item.id}`;
                resultsContainer.appendChild(div);
            });
        }

        // Fungsi untuk menonton Live
        function watchLive() {
            alert("🎥 Sedang mengarahkan ke siaran langsung...\n\nFitur live streaming sedang dalam pengembangan.\n\nUntuk sementara ini kita tampilkan video contoh.");
            window.location.href = "video-detail.php?id=7"; // Ganti dengan ID video live kalau ada
        }

                let isLivePlaying = false;

        function toggleLive() {
            const iframe = document.getElementById('live-iframe');
            const button = document.getElementById('live-button');

            if (!isLivePlaying) {
                // Mulai putar dengan autoplay
                iframe.src = "https://www.youtube.com/embed/aoAMH07nwHw";
                button.innerHTML = `<i class="fa-solid fa-pause"></i> PAUSE LIVE`;
                isLivePlaying = true;
            } else {
                // Pause video
                iframe.src = "https://www.youtube.com/embed/aoAMH07nwHw";
                button.innerHTML = `<i class="fa-solid fa-play"></i> TONTON SEKARANG`;
                isLivePlaying = false;
            }
        }

        
        function renderFavorites() {
            const container = document.getElementById('favorites-grid');
            if (!container) return;
            container.innerHTML = '';

            const favIds = JSON.parse(localStorage.getItem('favorites')) || [];

            if (favIds.length === 0) {
                container.innerHTML = `<p class="col-span-full text-gray-400 text-center py-12">Belum ada video favorit.</p>`;
                return;
            }

            const favVideos = allKonten.filter(item => favIds.includes(item.id));

            if (favVideos.length === 0) {
                container.innerHTML = `<p class="col-span-full text-gray-400 text-center py-12">Video favorit tidak ditemukan di database.</p>`;
                return;
            }

            favVideos.forEach(item => {
                const div = document.createElement('div');
                div.className = 'bg-[#1F2937] rounded-3xl overflow-hidden cursor-pointer card-hover group relative';

                div.innerHTML = `
                    <div class="relative">
                        <img src="${item.thumbnail || 'https://picsum.photos/id/1015/600/340'}" 
                             class="w-full aspect-video object-cover">
                        <div class="absolute bottom-2 right-2 bg-black/70 text-white text-xs px-2 py-1 rounded">
                            ${item.durasi || '00:00'}
                        </div>
                        
                        <!-- Tombol X (Close) -->
                        <button onclick="removeFavorite(${item.id}, event)" 
                                class="absolute top-3 right-3 bg-black/70 hover:bg-red-600 text-white w-8 h-8 rounded-full flex items-center justify-center transition-all z-10">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-sm leading-tight line-clamp-2 mb-3 group-hover:text-[#5879AC]">
                            ${item.judul}
                        </h3>
                        <div class="text-[#5879AC] text-sm flex items-center gap-2">
                            Tonton Video <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>
                `;

                div.onclick = (e) => {
                    if (!e.target.closest('button')) {
                        window.location.href = `video-detail.php?id=${item.id}`;
                    }
                };
                container.appendChild(div);
            });
        }

        // Fungsi untuk menghapus dari favorit
        function removeFavorite(id, event) {
            event.stopImmediatePropagation(); // Mencegah klik card

            let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            favorites = favorites.filter(favId => favId !== id);
            localStorage.setItem('favorites', JSON.stringify(favorites));

            // Render ulang halaman favorit
            renderFavorites();

            // Optional: beri notifikasi
            // alert("Video dihapus dari favorit");
        }

        // Play Featured Video dari Banner Utama (Sesuai Tema Hero)
             function playFeatured() {
            // Pilih ID video yang paling cocok dengan tema "Broadcasting? Siapa Takut"
            // Contoh: ganti 5 dengan ID video yang kamu inginkan
            const featuredVideoId = 7;   

            if (featuredVideoId) {
                window.location.href = `video-detail.php?id=${featuredVideoId}`;
            } else if (allKonten.length > 0) {
                window.location.href = `video-detail.php?id=${allKonten[0].id}`;
            } else {
                alert("Video belum tersedia.");
            }
        }

        // Preview Foto di Modal
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('preview-foto').src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        // Tampilkan Modal Edit
        function showEditProfileModal() {
            document.getElementById('edit-profile-modal').classList.remove('hidden');
        }

        // Sembunyikan Modal
        function hideEditProfileModal() {
            document.getElementById('edit-profile-modal').classList.add('hidden');
        }

        // Submit Form Edit Profil
        document.getElementById('edit-profile-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            try {
                const res = await fetch('proses-edit-profil.php', {
                    method: 'POST',
                    body: formData
                });
                
                const text = await res.text();
                
                if (text.includes("berhasil")) {
                    alert("✅ Profil berhasil diperbarui!");
                    hideEditProfileModal();
                    window.location.reload(); // Refresh agar perubahan terlihat
                } else {
                    alert("❌ Gagal menyimpan: " + text);
                }
            } catch (err) {
                alert("Terjadi kesalahan saat menyimpan.");
                console.error(err);
            }
        });

        // Load semua data konten (dipanggil sekali saat halaman dimuat)
        async function loadKonten() {
            try {
                const res = await fetch('get_konten.php');
                if (!res.ok) throw new Error('Gagal mengambil data');
                
                allKonten = await res.json();
                
                renderFavorites();   // Render favorit setelah data dimuat
                
                // Render yang perlu data
                renderPosterGrid();
                // renderCariKategori() sudah dipanggil di onload
            } catch(e) {
                console.error("Gagal load konten:", e);
            }
        }

       // Inisialisasi
        document.addEventListener('DOMContentLoaded', () => {
            loadKonten();
            renderCariKategori();
            renderFavorites();
            // renderReplays();     // ← Dinonaktifkan karena belum dibuat
            navigateTo('home');
            renderProfile();         // ← PENTING: Pastikan ini tidak dikomentari
            console.log("✅ Walisongo TV loaded successfully");
        });

        // Debug: Pastikan renderProfile dipanggil
        console.log("Script loaded - renderProfile siap");
    </script>
</body>
</html>
