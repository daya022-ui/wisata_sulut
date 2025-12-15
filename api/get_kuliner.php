<?php
require_once 'db.php';

// Ambil parameter dari query string
$search = isset($_GET['search']) ? sanitize($_GET['search']) : '';
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;

// Validasi limit dan offset
$limit = min($limit, 100);
$offset = max($offset, 0);

// Build query
$query = "SELECT id, name, description, image, alamat, latitude, longitude
          FROM kuliner WHERE 1=1";
$countQuery = "SELECT COUNT(*) as total FROM kuliner WHERE 1=1";

// Filter search
if (!empty($search)) {
    $query .= " AND (name LIKE ? OR description LIKE ? OR alamat LIKE ?)";
    $countQuery .= " AND (name LIKE ? OR description LIKE ? OR alamat LIKE ?)";
}

// Order dan limit
$query .= " ORDER BY created_at DESC LIMIT ? OFFSET ?";

// Prepare statement untuk count
if (!empty($search)) {
    $searchWildcard = '%' . $search . '%';
    $stmt = $conn->prepare($countQuery);
    $stmt->bind_param("sss", $searchWildcard, $searchWildcard, $searchWildcard);
} else {
    $stmt = $conn->prepare($countQuery);
}

$stmt->execute();
$countResult = $stmt->get_result();
$totalData = $countResult->fetch_assoc()['total'];
$stmt->close();

// Prepare statement untuk data
if (!empty($search)) {
    $searchWildcard = '%' . $search . '%';
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssii", $searchWildcard, $searchWildcard, $searchWildcard, $limit, $offset);
} else {
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $limit, $offset);
}

if (!$stmt->execute()) {
    sendResponse(false, 'Kesalahan database: ' . $stmt->error, null, 500);
}

$result = $stmt->get_result();
$kuliner = [];

while ($row = $result->fetch_assoc()) {
    $kuliner[] = $row;
}

$stmt->close();

sendResponse(true, 'Data kuliner berhasil diambil', [
    'data' => $kuliner,
    'pagination' => [
        'total' => $totalData,
        'limit' => $limit,
        'offset' => $offset,
        'pages' => ceil($totalData / $limit)
    ]
]);
?>