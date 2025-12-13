<?php

// Membuat koneksi mysqli
$conn = new mysqli("localhost", "root", "", "wisata_sulut", 3306);

// Cek koneksi
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Koneksi database gagal: ' . $conn->connect_error]));
}

// Set charset ke UTF-8
$conn->set_charset("utf8");

// Fungsi helper untuk response JSON
function sendResponse($success, $message, $data = null, $statusCode = 200) {
    http_response_code($statusCode);
    header('Content-Type: application/json; charset=utf-8');
    
    $response = [
        'success' => $success,
        'message' => $message
    ];
    
    if ($data !== null) {
        $response['data'] = $data;
    }
    
    echo json_encode($response);
    exit;
}

// Fungsi untuk mengamankan input
function sanitize($input) {
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}

// Fungsi untuk validasi file upload
function validateFileUpload($file, $maxSize = 5242880, $allowedTypes = ['jpg', 'jpeg', 'png', 'gif']) {
    if (!isset($file) || $file['error'] == 4) {
        return ['success' => false, 'message' => 'File tidak ditemukan'];
    }
    
    if ($file['error'] != 0) {
        return ['success' => false, 'message' => 'Terjadi kesalahan saat upload'];
    }
    
    if ($file['size'] > $maxSize) {
        return ['success' => false, 'message' => 'Ukuran file terlalu besar (max: 5MB)'];
    }
    
    $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($fileExt, $allowedTypes)) {
        return ['success' => false, 'message' => 'Tipe file tidak didukung'];
    }
    
    return ['success' => true];
}

// Fungsi untuk menyimpan file upload
function saveUploadedFile($file, $directory) {
    global $conn;
    
    $validation = validateFileUpload($file);
    if (!$validation['success']) {
        return $validation;
    }
    
    // Buat nama file unik
    $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $fileName = time() . '_' . uniqid() . '.' . $fileExt;
    $targetPath = $directory . $fileName;
    
    // Pastikan direktori ada
    if (!is_dir($directory)) {
        mkdir($directory, 0755, true);
    }
    
    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        return ['success' => true, 'fileName' => $fileName, 'path' => $targetPath];
    }
    
    return ['success' => false, 'message' => 'Gagal menyimpan file'];
}

// Set CORS headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

?>
