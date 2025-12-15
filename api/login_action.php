<?php
session_start();
require_once 'db.php';

header('Content-Type: application/json');

// Ambil data JSON
$data = json_decode(file_get_contents("php://input"), true);

$email    = trim($data['email'] ?? '');
$password = $data['password'] ?? '';
$remember = $data['remember'] ?? false;

// Validasi input
if (empty($email) || empty($password)) {
    echo json_encode([
        'success' => false,
        'message' => 'Email dan password harus diisi!'
    ]);
    exit;
}

// Validasi format email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        'success' => false,
        'message' => 'Format email tidak valid!'
    ]);
    exit;
}

// 🔹 MySQLi Prepared Statement
$stmt = $conn->prepare("SELECT id, name, email, password, role FROM users WHERE email = ? LIMIT 1");

if (!$stmt) {
    echo json_encode([
        'success' => false,
        'message' => 'Query gagal disiapkan'
    ]);
    exit;
}

$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();
$user   = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {

    // Set session
    $_SESSION['user_id']    = $user['id'];
    $_SESSION['user_name']  = $user['name'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_role']  = $user['role'];
    $_SESSION['login_time'] = time();

    // Remember me
    if ($remember) {
        $token = bin2hex(random_bytes(32));
        setcookie(
            'remember_token',
            $token,
            time() + (30 * 24 * 60 * 60),
            '/',
            '',
            false,
            true
        );
    }

    echo json_encode([
        'success' => true,
        'message' => 'Login berhasil',
        'data' => [
            'redirect' => 'admin/dashboard.php'
        ]
    ]);
    exit;
}

// Login gagal
echo json_encode([
    'success' => false,
    'message' => 'Email atau password salah!'
]);
exit;
