<?php
session_start();
require_once 'db.php';

// Validasi authentikasi
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    sendResponse(false, 'Anda harus login terlebih dahulu', null, 401);
}

if ($_SERVER['REQUEST_METHOD'] != 'POST' && $_SERVER['REQUEST_METHOD'] != 'DELETE') {
    sendResponse(false, 'Method tidak diizinkan', null, 405);
}

// Ambil ID dari request
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
if ($id <= 0 && $_SERVER['REQUEST_METHOD'] == 'DELETE') {
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

$wisata = $checkResult->fetch_assoc();
$checkStmt->close();

// Mulai transaction
$conn->begin_transaction();

try {
    // Ambil semua gambar galeri untuk dihapus
    $galleryStmt = $conn->prepare("SELECT image FROM galeri WHERE wisata_id = ?");
    $galleryStmt->bind_param("i", $id);
    $galleryStmt->execute();
    $galleryResult = $galleryStmt->get_result();
    
    $galleryImages = [];
    while ($row = $galleryResult->fetch_assoc()) {
        $galleryImages[] = $row['image'];
    }
    $galleryStmt->close();
    
    // Hapus reviews (akan otomatis cascade delete)
    $deleteReviewStmt = $conn->prepare("DELETE FROM review WHERE wisata_id = ?");
    $deleteReviewStmt->bind_param("i", $id);
    if (!$deleteReviewStmt->execute()) {
        throw new Exception('Gagal menghapus review: ' . $deleteReviewStmt->error);
    }
    $deleteReviewStmt->close();
    
    // Hapus galeri (akan otomatis cascade delete)
    $deleteGalleryStmt = $conn->prepare("DELETE FROM galeri WHERE wisata_id = ?");
    $deleteGalleryStmt->bind_param("i", $id);
    if (!$deleteGalleryStmt->execute()) {
        throw new Exception('Gagal menghapus galeri: ' . $deleteGalleryStmt->error);
    }
    $deleteGalleryStmt->close();
    
    // Hapus destinasi wisata
    $deleteWisataStmt = $conn->prepare("DELETE FROM destinasi_wisata WHERE id = ?");
    $deleteWisataStmt->bind_param("i", $id);
    if (!$deleteWisataStmt->execute()) {
        throw new Exception('Gagal menghapus destinasi: ' . $deleteWisataStmt->error);
    }
    $deleteWisataStmt->close();
    
    // Commit transaction
    $conn->commit();
    
    // Hapus file gambar dari server (setelah transaction berhasil)
    $uploadDir = '../img/wisata/';
    
    // Hapus main image
    if ($wisata['image'] && file_exists($uploadDir . $wisata['image'])) {
        unlink($uploadDir . $wisata['image']);
    }
    
    // Hapus gallery images
    foreach ($galleryImages as $image) {
        if ($image && file_exists($uploadDir . $image)) {
            unlink($uploadDir . $image);
        }
    }
    
    sendResponse(true, 'Destinasi wisata berhasil dihapus', [
        'deleted_id' => $id
    ]);

} catch (Exception $e) {
    // Rollback jika ada error
    $conn->rollback();
    sendResponse(false, 'Gagal menghapus data: ' . $e->getMessage(), null, 500);
}
?>