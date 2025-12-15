<?php
session_start();
require_once 'db.php';

// Validasi authentikasi
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    sendResponse(false, 'Anda harus login terlebih dahulu', null, 401);
}

if ($_SERVER['REQUEST_METHOD'] != 'POST' && $_SERVER['REQUEST_METHOD'] != 'PUT') {
    sendResponse(false, 'Method tidak diizinkan', null, 405);
}

// Ambil data dari request
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
if ($id <= 0 && $_SERVER['REQUEST_METHOD'] == 'PUT') {
    $input = json_decode(file_get_contents("php://input"), true);
    $id = isset($input['id']) ? intval($input['id']) : 0;
}

if ($id <= 0) {
    sendResponse(false, 'ID tidak valid', null, 400);
}

// Cek apakah wisata ada
$checkStmt = $conn->prepare("SELECT id, image FROM destinasi_wisata WHERE id = ?");
$checkStmt->bind_param("i", $id);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();
if ($checkResult->num_rows == 0) {
    sendResponse(false, 'Data wisata tidak ditemukan', null, 404);
}
$existingWisata = $checkResult->fetch_assoc();
$checkStmt->close();

// Ambil data dari request
$name = isset($_POST['name']) ? sanitize($_POST['name']) : null;
$location = isset($_POST['location']) ? sanitize($_POST['location']) : null;
$description = isset($_POST['description']) ? sanitize($_POST['description']) : null;
$latitude = isset($_POST['latitude']) ? floatval($_POST['latitude']) : null;
$longitude = isset($_POST['longitude']) ? floatval($_POST['longitude']) : null;
$category = isset($_POST['category']) ? sanitize($_POST['category']) : null;

// Validasi input yang diupdate
if ($name !== null && empty($name)) {
    sendResponse(false, 'Nama destinasi tidak boleh kosong', null, 400);
}

if ($location !== null && empty($location)) {
    sendResponse(false, 'Lokasi tidak boleh kosong', null, 400);
}

if ($description !== null && strlen($description) < 20) {
    sendResponse(false, 'Deskripsi minimal 20 karakter', null, 400);
}

if ($category !== null && empty($category)) {
    sendResponse(false, 'Kategori tidak boleh kosong', null, 400);
}

$imageName = $existingWisata['image'];

// Proses upload image jika ada
if (isset($_FILES['image']) && $_FILES['image']['error'] != 4) {
    $uploadDir = '../img/wisata/';
    $uploadResult = saveUploadedFile($_FILES['image'], $uploadDir);
    
    if (!$uploadResult['success']) {
        sendResponse(false, $uploadResult['message'], null, 400);
    }
    
    // Hapus file lama
    if ($imageName && file_exists($uploadDir . $imageName)) {
        unlink($uploadDir . $imageName);
    }
    
    $imageName = $uploadResult['fileName'];
}

// Build update query dinamis
$updateFields = [];
$updateValues = [];
$types = '';

if ($name !== null) {
    $updateFields[] = 'name = ?';
    $updateValues[] = $name;
    $types .= 's';
}

if ($location !== null) {
    $updateFields[] = 'location = ?';
    $updateValues[] = $location;
    $types .= 's';
}

if ($description !== null) {
    $updateFields[] = 'description = ?';
    $updateValues[] = $description;
    $types .= 's';
}

if ($latitude !== null) {
    $updateFields[] = 'latitude = ?';
    $updateValues[] = $latitude;
    $types .= 'd';
}

if ($longitude !== null) {
    $updateFields[] = 'longitude = ?';
    $updateValues[] = $longitude;
    $types .= 'd';
}

if ($category !== null) {
    $updateFields[] = 'category = ?';
    $updateValues[] = $category;
    $types .= 's';
}

if ($imageName) {
    $updateFields[] = 'image = ?';
    $updateValues[] = $imageName;
    $types .= 's';
}

// Jika tidak ada field yang diupdate
if (empty($updateFields)) {
    sendResponse(false, 'Tidak ada data yang diupdate', null, 400);
}

// Update timestamp
$updateFields[] = 'updated_at = CURRENT_TIMESTAMP';

$query = "UPDATE destinasi_wisata SET " . implode(', ', $updateFields) . " WHERE id = ?";
$types .= 'i';
$updateValues[] = $id;

$stmt = $conn->prepare($query);
if (!$stmt) {
    sendResponse(false, 'Kesalahan database: ' . $conn->error, null, 500);
}

$stmt->bind_param($types, ...$updateValues);

if (!$stmt->execute()) {
    sendResponse(false, 'Gagal mengupdate destinasi: ' . $stmt->error, null, 500);
}

$stmt->close();

// Ambil data yang sudah diupdate
$selectStmt = $conn->prepare("SELECT id, name, location, description, latitude, longitude, image, category FROM destinasi_wisata WHERE id = ?");
$selectStmt->bind_param("i", $id);
$selectStmt->execute();
$result = $selectStmt->get_result();
$updatedWisata = $result->fetch_assoc();
$selectStmt->close();

sendResponse(true, 'Destinasi wisata berhasil diupdate', [
    'wisata' => $updatedWisata
]);
?>