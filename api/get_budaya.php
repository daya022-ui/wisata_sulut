<?php
require_once 'db.php';

// Ambil parameter dari query string
$category = isset($_GET['category']) ? sanitize($_GET['category']) : '';
$search = isset($_GET['search']) ? sanitize($_GET['search']) : '';
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;

// Validasi limit dan offset
$limit = min($limit, 100);
$offset = max($offset, 0);

// Build query
$query = "SELECT id, title, content, image, category FROM budaya WHERE 1=1";
$countQuery = "SELECT COUNT(*) as total FROM budaya WHERE 1=1";

// Filter kategori
if (!empty($category)) {
    $query .= " AND category = ?";
    $countQuery .= " AND category = ?";
}

// Filter search
if (!empty($search)) {
    $query .= " AND (title LIKE ? OR content LIKE ?)";
    $countQuery .= " AND (title LIKE ? OR content LIKE ?)";
}

// Order dan limit
$query .= " ORDER BY created_at DESC LIMIT ? OFFSET ?";

// Prepare statement untuk count
if (!empty($category) && !empty($search)) {
    $searchWildcard = '%' . $search . '%';
    $stmt = $conn->prepare($countQuery);
    $stmt->bind_param("sss", $category, $searchWildcard, $searchWildcard);
} elseif (!empty($category)) {
    $stmt = $conn->prepare($countQuery);
    $stmt->bind_param("s", $category);
} elseif (!empty($search)) {
    $searchWildcard = '%' . $search . '%';
    $stmt = $conn->prepare($countQuery);
    $stmt->bind_param("ss", $searchWildcard, $searchWildcard);
} else {
    $stmt = $conn->prepare($countQuery);
}

$stmt->execute();
$countResult = $stmt->get_result();
$totalData = $countResult->fetch_assoc()['total'];
$stmt->close();

// Prepare statement untuk data
if (!empty($category) && !empty($search)) {
    $searchWildcard = '%' . $search . '%';
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssii", $category, $searchWildcard, $searchWildcard, $limit, $offset);
} elseif (!empty($category)) {
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sii", $category, $limit, $offset);
} elseif (!empty($search)) {
    $searchWildcard = '%' . $search . '%';
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssii", $searchWildcard, $searchWildcard, $limit, $offset);
} else {
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $limit, $offset);
}

if (!$stmt->execute()) {
    sendResponse(false, 'Kesalahan database: ' . $stmt->error, null, 500);
}

$result = $stmt->get_result();
$budaya = [];

while ($row = $result->fetch_assoc()) {
    // Potong content untuk preview (max 200 characters)
    $row['preview'] = substr($row['content'], 0, 200) . '...';
    $budaya[] = $row;
}

$stmt->close();

sendResponse(true, 'Data budaya berhasil diambil', [
    'data' => $budaya,
    'pagination' => [
        'total' => $totalData,
        'limit' => $limit,
        'offset' => $offset,
        'pages' => ceil($totalData / $limit)
    ]
]);
?>