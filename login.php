<?php
// login.php - Versi Final & Stabil


session_start();
include 'koneksi.php';

// ======================= dummy buat generate hash password
// di-comment karena hanya untuk generate hash password sekali aja, tidak perlu dijalankan setiap kali register
    // echo password_hash("admin123", PASSWORD_DEFAULT);
    // exit;

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$identity = trim($data['identity'] ?? '');
$password = trim($data['password'] ?? '');

if (empty($identity) || empty($password)) {
    echo json_encode(['status' => 'error', 'message' => 'Email/NIM dan password wajib diisi']);
    exit;
}

try {
    // Cek apakah input adalah email atau NIM
    if (filter_var($identity, FILTER_VALIDATE_EMAIL)) {
        $stmt = $pdo->prepare("SELECT id, nama_lengkap, email, photo, role, password FROM users WHERE email = ?");
    } else {
        $stmt = $pdo->prepare("SELECT id, nama_lengkap, email, photo, role, password FROM users WHERE nim = ?");
    }

    $stmt->execute([$identity]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {

        // Set session
        $_SESSION['login'] = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['nama'] = $user['nama_lengkap'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['foto'] = $user['photo'];

        echo json_encode([
            'status' => 'success',
            'user' => [
                'nama'  => $user['nama_lengkap'],
                'email' => $user['email'],
                'foto'  => $user['photo']
            ]
        ]);

    } else {
        echo json_encode(['status' => 'error', 'message' => 'Email/NIM atau password salah!']);
    }

} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>