<?php
// api/get_detail_kuliner.php

require_once 'db.php';

header('Content-Type: application/json; charset=utf-8');

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

// Ambil ID dari query string
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    sendResponse(false, 'ID tidak valid', null, 400);
}

// Query data kuliner
$stmt = $conn->prepare("SELECT id, name, description, image, alamat, latitude, longitude 
                        FROM kuliner 
                        WHERE id = ?");

if (!$stmt) {
    sendResponse(false, 'Kesalahan database: ' . $conn->error, null, 500);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    sendResponse(false, 'Data kuliner tidak ditemukan', null, 404);
}

$kuliner = $result->fetch_assoc();
$stmt->close();

// Ambil galeri kuliner
$galleryStmt = $conn->prepare("SELECT id, image FROM galeri_kuliner WHERE kuliner_id = ? ORDER BY id DESC");
$galleryStmt->bind_param("i", $id);
$galleryStmt->execute();
$galleryResult = $galleryStmt->get_result();

$gallery = [];
while ($photo = $galleryResult->fetch_assoc()) {
    $gallery[] = $photo;
}
$galleryStmt->close();

// Susun response
$data = [
    'kuliner' => $kuliner,
    'gallery' => $gallery
];

sendResponse(true, 'Detail kuliner berhasil diambil', $data);
?>