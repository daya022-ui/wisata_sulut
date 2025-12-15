<?php
require_once 'db.php';

// Ambil parameter dari query string
$wisataId = isset($_GET['wisata_id']) ? intval($_GET['wisata_id']) : 0;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$sortBy = isset($_GET['sort']) ? sanitize($_GET['sort']) : 'latest'; // latest, rating_high, rating_low

// Validasi
if ($wisataId <= 0) {
    sendResponse(false, 'ID wisata tidak valid', null, 400);
}

$limit = min($limit, 100);
$offset = max($offset, 0);

// Cek apakah wisata ada
$checkStmt = $conn->prepare("SELECT id FROM destinasi_wisata WHERE id = ?");
$checkStmt->bind_param("i", $wisataId);
$checkStmt->execute();
if ($checkStmt->get_result()->num_rows == 0) {
    sendResponse(false, 'Data wisata tidak ditemukan', null, 404);
}
$checkStmt->close();

// Count total reviews
$countStmt = $conn->prepare("SELECT COUNT(*) as total FROM review WHERE wisata_id = ?");
$countStmt->bind_param("i", $wisataId);
$countStmt->execute();
$countResult = $countStmt->get_result();
$totalData = $countResult->fetch_assoc()['total'];
$countStmt->close();

// Determine order by
$orderBy = "created_at DESC"; // default latest
if ($sortBy == 'rating_high') {
    $orderBy = "rating DESC, created_at DESC";
} elseif ($sortBy == 'rating_low') {
    $orderBy = "rating ASC, created_at DESC";
}

// Get reviews
$query = "SELECT id, name, email, rating, comment, created_at FROM review 
          WHERE wisata_id = ? ORDER BY " . $orderBy . " LIMIT ? OFFSET ?";

$stmt = $conn->prepare($query);
if (!$stmt) {
    sendResponse(false, 'Kesalahan database: ' . $conn->error, null, 500);
}

$stmt->bind_param("iii", $wisataId, $limit, $offset);

if (!$stmt->execute()) {
    sendResponse(false, 'Kesalahan database: ' . $stmt->error, null, 500);
}

$result = $stmt->get_result();
$reviews = [];

while ($row = $result->fetch_assoc()) {
    // Sembunyikan email sebagian
    $emailParts = explode('@', $row['email']);
    $row['email_masked'] = substr($emailParts[0], 0, 2) . '***@' . $emailParts[1];
    $reviews[] = $row;
}

$stmt->close();

// Get average rating
$ratingStmt = $conn->prepare("SELECT 
                               AVG(rating) as avg_rating,
                               COUNT(*) as total_count,
                               SUM(CASE WHEN rating = 5 THEN 1 ELSE 0 END) as five_star,
                               SUM(CASE WHEN rating = 4 THEN 1 ELSE 0 END) as four_star,
                               SUM(CASE WHEN rating = 3 THEN 1 ELSE 0 END) as three_star,
                               SUM(CASE WHEN rating = 2 THEN 1 ELSE 0 END) as two_star,
                               SUM(CASE WHEN rating = 1 THEN 1 ELSE 0 END) as one_star
                               FROM review WHERE wisata_id = ?");
$ratingStmt->bind_param("i", $wisataId);
$ratingStmt->execute();
$ratingData = $ratingStmt->get_result()->fetch_assoc();
$ratingStmt->close();

sendResponse(true, 'Review berhasil diambil', [
    'reviews' => $reviews,
    'statistics' => [
        'avg_rating' => $ratingData['avg_rating'] ? round($ratingData['avg_rating'], 2) : 0,
        'total_reviews' => $ratingData['total_count'] ?? 0,
        'rating_breakdown' => [
            'five_star' => $ratingData['five_star'] ?? 0,
            'four_star' => $ratingData['four_star'] ?? 0,
            'three_star' => $ratingData['three_star'] ?? 0,
            'two_star' => $ratingData['two_star'] ?? 0,
            'one_star' => $ratingData['one_star'] ?? 0
        ]
    ],
    'pagination' => [
        'total' => $totalData,
        'limit' => $limit,
        'offset' => $offset,
        'pages' => ceil($totalData / $limit)
    ]
]);
?>