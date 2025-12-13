<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    sendResponse(false, 'Method tidak diizinkan', null, 405);
}

// Ambil data dari request
$input = json_decode(file_get_contents("php://input"), true);

if (!$input) {
    // Coba dari POST form
    $email = isset($_POST['email']) ? sanitize($_POST['email']) : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;
} else {
    $email = isset($input['email']) ? sanitize($input['email']) : null;
    $password = isset($input['password']) ? $input['password'] : null;
}

// Validasi input
if (empty($email) || empty($password)) {
    sendResponse(false, 'Email dan password tidak boleh kosong', null, 400);
}

// Validasi format email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    sendResponse(false, 'Format email tidak valid', null, 400);
}

// Cari user di database
$stmt = $conn->prepare("SELECT id, name, email, password, role FROM users WHERE email = ?");
if (!$stmt) {
    sendResponse(false, 'Kesalahan database: ' . $conn->error, null, 500);
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    sendResponse(false, 'Email atau password salah', null, 401);
}

$user = $result->fetch_assoc();
$stmt->close();

// Verifikasi password
if (!password_verify($password, $user['password'])) {
    sendResponse(false, 'Email atau password salah', null, 401);
}

// Buat session untuk user
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['name'];
$_SESSION['user_email'] = $user['email'];
$_SESSION['user_role'] = $user['role'];
$_SESSION['logged_in'] = true;

// Hapus password dari response
unset($user['password']);

sendResponse(true, 'Login berhasil', [
    'user' => $user,
    'redirect' => 'admin/dashboard.php'
]);
?>