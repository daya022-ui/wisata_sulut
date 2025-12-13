<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    sendResponse(false, 'Method tidak diizinkan', null, 405);
}

// Ambil data dari request
$input = json_decode(file_get_contents("php://input"), true);

if (!$input) {
    $wisataId = isset($_POST['wisata_id']) ? intval($_POST['wisata_id']) : 0;
    $name = isset($_POST['name']) ? sanitize($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitize($_POST['email']) : '';
    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0;
    $comment = isset($_POST['comment']) ? sanitize($_POST['comment']) : '';
} else {
    $wisataId = isset($input['wisata_id']) ? intval($input['wisata_id']) : 0;
    $name = isset($input['name']) ? sanitize($input['name']) : '';
    $email = isset($input['email']) ? sanitize($input['email']) : '';
    $rating = isset($input['rating']) ? intval($input['rating']) : 0;
    $comment = isset($input['comment']) ? sanitize($input['comment']) : '';
}

// Validasi input
if ($wisataId <= 0) {
    sendResponse(false, 'ID wisata tidak valid', null, 400);
}

if (empty($name)) {
    sendResponse(false, 'Nama tidak boleh kosong', null, 400);
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    sendResponse(false, 'Email tidak valid', null, 400);
}

if ($rating < 1 || $rating > 5) {
    sendResponse(false, 'Rating harus antara 1-5', null, 400);
}

if (empty($comment)) {
    sendResponse(false, 'Komentar tidak boleh kosong', null, 400);
}

if (strlen($comment) < 10) {
    sendResponse(false, 'Komentar minimal 10 karakter', null, 400);
}

if (strlen($comment) > 1000) {
    sendResponse(false, 'Komentar maksimal 1000 karakter', null, 400);
}

// Cek apakah wisata ada
$checkStmt = $conn->prepare("SELECT id FROM destinasi_wisata WHERE id = ?");
$checkStmt->bind_param("i", $wisataId);
$checkStmt->execute();
if ($checkStmt->get_result()->num_rows == 0) {
    sendResponse(false, 'Data wisata tidak ditemukan', null, 404);
}
$checkStmt->close();

// Cek apakah user sudah review (optional - bisa disesuaikan)
// Uncomment jika ingin limit 1 review per email
/*
$dupeStmt = $conn->prepare("SELECT id FROM review WHERE wisata_id = ? AND email = ?");
$dupeStmt->bind_param("is", $wisataId, $email);
$dupeStmt->execute();
if ($dupeStmt->get_result()->num_rows > 0) {
    sendResponse(false, 'Anda sudah memberikan review untuk destinasi ini', null, 400);
}
$dupeStmt->close();
*/

// Insert review
$stmt = $conn->prepare("INSERT INTO review (wisata_id, name, email, rating, comment) VALUES (?, ?, ?, ?, ?)");

if (!$stmt) {
    sendResponse(false, 'Kesalahan database: ' . $conn->error, null, 500);
}

$stmt->bind_param("issss", $wisataId, $name, $email, $rating, $comment);

if (!$stmt->execute()) {
    sendResponse(false, 'Gagal menyimpan review: ' . $stmt->error, null, 500);
}

$reviewId = $stmt->insert_id;
$stmt->close();

// Ambil data review yang baru dibuat
$selectStmt = $conn->prepare("SELECT id, wisata_id, name, email, rating, comment, created_at FROM review WHERE id = ?");
$selectStmt->bind_param("i", $reviewId);
$selectStmt->execute();
$result = $selectStmt->get_result();
$newReview = $result->fetch_assoc();
$selectStmt->close();

sendResponse(true, 'Review berhasil ditambahkan', [
    'review' => $newReview
], 201);
?>