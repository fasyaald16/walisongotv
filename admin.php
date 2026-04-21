<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Walisongo TV</title>
    <script src="https://cdn.tailwindcss.com/3.4.14"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-[#080B15] text-white min-h-screen">
    <div class="max-w-2xl mx-auto p-8">
        <h1 class="text-4xl font-bold text-[#5879AC] mb-8 flex items-center gap-3">
            <i class="fa-solid fa-cog"></i> Admin Dashboard
        </h1>

        <form action="upload.php" method="POST" enctype="multipart/form-data" class="bg-[#1F2937] p-8 rounded-3xl">
            <input type="text" name="judul" placeholder="Judul Konten" required class="w-full p-4 mb-4 bg-[#0F172A] rounded-2xl">
            
            <select name="kategori" class="w-full p-4 mb-4 bg-[#0F172A] rounded-2xl">
                <option value="News">News</option>
                <option value="Film">Film</option>
                <option value="Tastory">Tastory</option>
                <option value="Edukasi">Edukasi</option>
                <option value="Dakwah">Dakwah</option>
                <option value="Inspiratif">Inspiratif</option>
            </select>

            <textarea name="deskripsi" placeholder="Deskripsi singkat" class="w-full p-4 mb-4 bg-[#0F172A] rounded-2xl h-32"></textarea>
            <input type="text" name="durasi" placeholder="Durasi (contoh: 2:27:20)" class="w-full p-4 mb-6 bg-[#0F172A] rounded-2xl">

            <label class="block text-sm mb-2">Thumbnail (Gambar)</label>
            <input type="file" name="thumbnail" accept="image/*" required class="w-full p-4 mb-6 bg-[#0F172A] rounded-2xl">

            <label class="block text-sm mb-2">Video (.mp4)</label>
            <input type="file" name="video" accept="video/mp4" required class="w-full p-4 mb-8 bg-[#0F172A] rounded-2xl">

            <button type="submit" class="w-full py-5 bg-[#5879AC] rounded-3xl font-bold text-lg">UPLOAD KE WALISONGO TV</button>
        </form>

        <a href="index.html" class="block text-center mt-6 text-[#5879AC] hover:underline">← Kembali ke Website</a>
    </div>
</body>
</html>