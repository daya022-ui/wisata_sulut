<?php
session_start();
require_once 'db.php';

// Validasi authentikasi
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    sendResponse(false, 'Anda harus login terlebih dahulu', null, 401);
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    sendResponse(false, 'Method tidak diizinkan', null, 405);
}

// Ambil data dari request
$name = isset($_POST['name']) ? sanitize($_POST['name']) : '';
$location = isset($_POST['location']) ? sanitize($_POST['location']) : '';
$description = isset($_POST['description']) ? sanitize($_POST['description']) : '';
$latitude = isset($_POST['latitude']) ? floatval($_POST['latitude']) : 0;
$longitude = isset($_POST['longitude']) ? floatval($_POST['longitude']) : 0;
$category = isset($_POST['category']) ? sanitize($_POST['category']) : '';
$imageName = null;

// Validasi input
if (empty($name)) {
    sendResponse(false, 'Nama destinasi tidak boleh kosong', null, 400);
}

if (empty($location)) {
    sendResponse(false, 'Lokasi tidak boleh kosong', null, 400);
}

if (empty($description) || strlen($description) < 20) {
    sendResponse(false, 'Deskripsi minimal 20 karakter', null, 400);
}

if ($latitude == 0 || $longitude == 0) {
    sendResponse(false, 'Koordinat latitude dan longitude harus valid', null, 400);
}

if (empty($category)) {
    sendResponse(false, 'Kategori tidak boleh kosong', null, 400);
}

// Proses upload image jika ada
if (isset($_FILES['image']) && $_FILES['image']['error'] != 4) {
    $uploadDir = '../img/wisata/';
    $uploadResult = saveUploadedFile($_FILES['image'], $uploadDir);
    
    if (!$uploadResult['success']) {
        sendResponse(false, $uploadResult['message'], null, 400);
    }
    
    $imageName = $uploadResult['fileName'];
}

// Insert ke database
$stmt = $conn->prepare("INSERT INTO destinasi_wisata (name, location, description, latitude, longitude, image, category) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    sendResponse(false, 'Kesalahan database: ' . $conn->error, null, 500);
}

$stmt->bind_param("sssddss", $name, $location, $description, $latitude, $longitude, $imageName, $category);

if (!$stmt->execute()) {
    // Hapus file jika insert gagal
    if ($imageName) {
        unlink('../img/wisata/' . $imageName);
    }
    sendResponse(false, 'Gagal menambahkan destinasi: ' . $stmt->error, null, 500);
}

$wisataId = $stmt->insert_id;
$stmt->close();

// Ambil data yang baru dibuat
$selectStmt = $conn->prepare("SELECT id, name, location, description, latitude, longitude, image, category FROM destinasi_wisata WHERE id = ?");
$selectStmt->bind_param("i", $wisataId);
$selectStmt->execute();
$result = $selectStmt->get_result();
$newWisata = $result->fetch_assoc();
$selectStmt->close();

sendResponse(true, 'Destinasi wisata berhasil ditambahkan', [
    'wisata' => $newWisata
], 201);
?>