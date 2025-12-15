<?php
require_once 'db.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Ambil ID dari query string
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    sendResponse(false, 'ID tidak valid', null, 400);
}

// Query data wisata
$stmt = $conn->prepare("SELECT id, name, description, location, category, latitude, longitude, image 
                        FROM destinasi_wisata 
                        WHERE id = ?");
if (!$stmt) {
    sendResponse(false, 'Kesalahan database: ' . $conn->error, null, 500);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    sendResponse(false, 'Data wisata tidak ditemukan', null, 404);
}

$wisata = $result->fetch_assoc();
$stmt->close();

// Ambil galeri
$galleryStmt = $conn->prepare("SELECT id, image FROM galeri_wisata WHERE wisata_id = ? ORDER BY id DESC");
$galleryStmt->bind_param("i", $id);
$galleryStmt->execute();
$galleryResult = $galleryStmt->get_result();

$gallery = [];
while ($photo = $galleryResult->fetch_assoc()) {
    $gallery[] = $photo;
}
$galleryStmt->close();

// Ambil review
$reviewStmt = $conn->prepare("SELECT id, name, email, rating, comment, created_at FROM review 
                              WHERE wisata_id = ? ORDER BY created_at DESC LIMIT 10");
$reviewStmt->bind_param("i", $id);
$reviewStmt->execute();
$reviewResult = $reviewStmt->get_result();

$reviews = [];
$totalRating = 0;
$ratingCount = 0;

while ($review = $reviewResult->fetch_assoc()) {
    $reviews[] = $review;
    $totalRating += $review['rating'];
    $ratingCount++;
}
$reviewStmt->close();

// Hitung average rating
$avgRating = $ratingCount > 0 ? round($totalRating / $ratingCount, 2) : 0;

// Ambil statistik review
$statsStmt = $conn->prepare("SELECT COUNT(*) as total_reviews, AVG(rating) as avg_rating FROM review WHERE wisata_id = ?");
$statsStmt->bind_param("i", $id);
$statsStmt->execute();
$statsResult = $statsStmt->get_result();
$stats = $statsResult->fetch_assoc();
$statsStmt->close();

// Ambil rating distribution
$ratingDistStmt = $conn->prepare("SELECT rating, COUNT(*) as count FROM review WHERE wisata_id = ? GROUP BY rating ORDER BY rating DESC");
$ratingDistStmt->bind_param("i", $id);
$ratingDistStmt->execute();
$ratingDistResult = $ratingDistStmt->get_result();

$ratingDistribution = [];
while ($dist = $ratingDistResult->fetch_assoc()) {
    $ratingDistribution[] = $dist;
}
$ratingDistStmt->close();

// Susun response
$data = [
    'wisata' => $wisata,
    'gallery' => $gallery,
    'reviews' => $reviews,
    'statistics' => [
        'avg_rating' => $avgRating,
        'total_reviews' => $stats['total_reviews'] ?? 0,
        'rating_distribution' => $ratingDistribution
    ]
];

sendResponse(true, 'Detail wisata berhasil diambil', $data);
?>