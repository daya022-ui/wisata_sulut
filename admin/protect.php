<?php
// Pastikan session sudah dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

/**
 * Fungsi untuk mengecek apakah user sudah login
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['user_email']);
}

/**
 * Fungsi untuk mengecek role user
 */
function hasRole($requiredRole) {
    if (!isLoggedIn()) {
        return false;
    }
    
    $userRole = $_SESSION['user_role'] ?? '';
    
    // Superadmin bisa akses semua
    if ($userRole === 'superadmin') {
        return true;
    }
    
    // Cek role spesifik
    return $userRole === $requiredRole;
}

/**
 * Fungsi untuk memaksa login
 */
function requireLogin() {
    if (!isLoggedIn()) {
        $_SESSION['login_error'] = 'Silakan login terlebih dahulu untuk mengakses halaman ini.';
        header('Location: ../auth/login.php');
        exit();
    }
}

/**
 * Fungsi untuk memaksa role tertentu
 */
function requireRole($requiredRole) {
    requireLogin();
    
    if (!hasRole($requiredRole)) {
        http_response_code(403);
        echo '<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak - 403</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .error-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            padding: 2rem;
            text-align: center;
        }
        .error-content {
            background: white;
            padding: 3rem 2rem;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 500px;
        }
        .error-icon {
            font-size: 5rem;
            margin-bottom: 1rem;
        }
        .error-code {
            font-size: 3rem;
            color: var(--primary);
            font-weight: 800;
            margin-bottom: 1rem;
        }
        .error-message {
            color: var(--text-light);
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }
        .error-btn {
            display: inline-block;
            padding: 1rem 2rem;
            background: var(--primary);
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .error-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="error-page">
        <div class="error-content">
            <div class="error-icon">🚫</div>
            <h1 class="error-code">403</h1>
            <p class="error-message">
                Maaf, Anda tidak memiliki akses ke halaman ini.<br>
                Role Anda: <strong>' . htmlspecialchars($_SESSION['user_role'] ?? 'Unknown') . '</strong>
            </p>
            <a href="dashboard.php" class="error-btn">Kembali ke Dashboard</a>
        </div>
    </div>
</body>
</html>';
        exit();
    }
}

/**
 * Fungsi untuk mendapatkan nama user yang sedang login
 */
function getLoggedInUserName() {
    return $_SESSION['user_name'] ?? 'Guest';
}

/**
 * Fungsi untuk mendapatkan role user yang sedang login
 */
function getLoggedInUserRole() {
    return $_SESSION['user_role'] ?? 'guest';
}

/**
 * Fungsi untuk cek session timeout (opsional)
 * Timeout setelah 2 jam tidak aktif
 */
function checkSessionTimeout($timeoutSeconds = 60) // 1 menit
{
    if (!isset($_SESSION['login_time'])) {
        session_unset();
        session_destroy();
        header('Location: ../auth/login.php');
        exit();
    }

    $inactive = time() - $_SESSION['login_time'];

    if ($inactive > $timeoutSeconds) {
        session_unset();
        session_destroy();

        session_start();
        $_SESSION['login_error'] = 'Session berakhir karena tidak aktif selama 1 menit.';
        header('Location: ../auth/login.php');
        exit();
    }

    // Update waktu terakhir aktif
    $_SESSION['login_time'] = time();
}


// Proteksi default: pastikan user sudah login
requireLogin();

// Cek session timeout
checkSessionTimeout();
?>