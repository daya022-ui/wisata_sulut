<?php
require_once 'db.php';

// Ambil parameter
$category = isset($_GET['category']) ? sanitize($_GET['category']) : '';
$search = isset($_GET['search']) ? sanitize($_GET['search']) : '';
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;

$limit = min($limit, 100);
$offset = max($offset, 0);

// Base Query
$query = "SELECT id, name, location, description, latitude, longitude, image, category 
          FROM destinasi_wisata WHERE 1=1";
$countQuery = "SELECT COUNT(*) as total FROM destinasi_wisata WHERE 1=1";

// Tambah filter
$params = [];
$types = "";

// filter kategori
if (!empty($category)) {
    $query .= " AND category = ?";
    $countQuery .= " AND category = ?";
    $params[] = $category;
    $types .= "s";
}

// filter search
if (!empty($search)) {
    $query .= " AND (name LIKE ? OR location LIKE ? OR description LIKE ?)";
    $countQuery .= " AND (name LIKE ? OR location LIKE ? OR description LIKE ?)";
    
    $searchWildcard = "%$search%";
    $params = array_merge($params, [$searchWildcard, $searchWildcard, $searchWildcard]);
    $types .= "sss";
}

// Eksekusi COUNT
$stmt = $conn->prepare($countQuery);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$totalData = $stmt->get_result()->fetch_assoc()['total'];
$stmt->close();

// Tambah ORDER + LIMIT
$query .= " ORDER BY id DESC LIMIT ? OFFSET ?";
$paramsQuery = $params;
$typesQuery = $types . "ii";
$paramsQuery[] = $limit;
$paramsQuery[] = $offset;

// Eksekusi QUERY utama
$stmt = $conn->prepare($query);
$stmt->bind_param($typesQuery, ...$paramsQuery);
$stmt->execute();
$result = $stmt->get_result();

$wisata = [];

while ($row = $result->fetch_assoc()) {

    // Ambil galeri
    $galleryStmt = $conn->prepare("SELECT id, image FROM galeri_wisata WHERE wisata_id = ? LIMIT 5");
    $galleryStmt->bind_param("i", $row['id']);
    $galleryStmt->execute();
    $gallery = $galleryStmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $galleryStmt->close();

    // Rating
    $ratingStmt = $conn->prepare("SELECT AVG(rating) as avg_rating, COUNT(*) as review_count FROM review WHERE wisata_id = ?");
    $ratingStmt->bind_param("i", $row['id']);
    $ratingStmt->execute();
    $ratingData = $ratingStmt->get_result()->fetch_assoc();
    $ratingStmt->close();

    $row['gallery'] = $gallery;
    $row['avg_rating'] = $ratingData['avg_rating'] ? round($ratingData['avg_rating'], 2) : 0;
    $row['review_count'] = $ratingData['review_count'] ?? 0;

    $wisata[] = $row;
}

$stmt->close();

header("Content-Type: application/json");
echo json_encode([
    "success" => true,
    "data" => $wisata, // ← ini array yang benar
    "pagination" => [
        "total" => $totalData,  // ← jumlah data yang benar
        "limit" => $limit,
        "offset" => $offset,
        "pages" => ceil($totalData / $limit)
    ]
]);
