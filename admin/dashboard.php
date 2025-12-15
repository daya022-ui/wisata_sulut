<?php
require_once __DIR__ . '/protect.php';
require_once __DIR__ . '/../api/db.php';

try {
    $total_wisata  = $conn->query("SELECT COUNT(*) AS total FROM destinasi_wisata")->fetch_assoc()['total'];
    $total_kuliner = $conn->query("SELECT COUNT(*) AS total FROM kuliner")->fetch_assoc()['total'];
    $total_budaya  = $conn->query("SELECT COUNT(*) AS total FROM budaya")->fetch_assoc()['total'];
    $total_users   = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];

} catch (Exception $e) {
    $total_wisata = $total_kuliner = $total_budaya = $total_users = 0;
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Wisata Sulawesi Utara</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .admin-layout { display: flex; min-height: 100vh; }
        .sidebar { width: 280px; background: linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; padding: 2rem 0; position: fixed; height: 100vh; overflow-y: auto; box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1); }
        .sidebar-header { padding: 0 1.5rem 2rem; border-bottom: 1px solid rgba(255, 255, 255, 0.1); margin-bottom: 2rem; }
        .sidebar-header h2 { font-size: 1.5rem; margin-bottom: 0.5rem; color: white; }
        .sidebar-header p { font-size: 0.9rem; opacity: 0.8; }
        .sidebar-menu { list-style: none; padding: 0; }
        .sidebar-menu li { margin-bottom: 0.5rem; }
        .sidebar-menu a { display: flex; align-items: center; gap: 1rem; padding: 1rem 1.5rem; color: white; transition: all 0.3s ease; font-weight: 500; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background: rgba(255, 255, 255, 0.1); border-left: 4px solid white; }
        .sidebar-menu .icon { font-size: 1.3rem; }
        .main-content { flex: 1; margin-left: 280px; background: #f5f7fa; }
        .top-bar { background: white; padding: 1.5rem 2rem; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); display: flex; justify-content: space-between; align-items: center; }
        .user-info { display: flex; align-items: center; gap: 1rem; }
        .user-avatar { width: 45px; height: 45px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1.2rem; }
        .user-details h4 { font-size: 1rem; color: var(--primary); margin-bottom: 0.2rem; }
        .user-details p { font-size: 0.85rem; color: var(--text-light); }
        .logout-btn { padding: 0.7rem 1.5rem; background: #dc3545; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600; transition: all 0.3s ease; }
        .logout-btn:hover { background: #c82333; transform: translateY(-2px); }
        .dashboard-content { padding: 2rem; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
        .stat-card { background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); display: flex; align-items: center; gap: 1.5rem; transition: all 0.3s ease; }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); }
        .stat-icon { width: 70px; height: 70px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 2rem; color: white; }
        .stat-icon.blue { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .stat-icon.green { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .stat-icon.orange { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        .stat-icon.purple { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
        .stat-info h3 { font-size: 2rem; color: var(--primary); margin-bottom: 0.3rem; }
        .stat-info p { color: var(--text-light); font-size: 0.95rem; }
        .welcome-card { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); color: white; padding: 2.5rem; border-radius: 12px; margin-bottom: 2rem; box-shadow: 0 8px 20px rgba(0, 26, 77, 0.2); }
        .welcome-card h1 { font-size: 2rem; margin-bottom: 0.5rem; color: white; }
        .welcome-card p { font-size: 1.1rem; opacity: 0.9; }
        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-content { margin-left: 0; }
            .top-bar { flex-direction: column; gap: 1rem; }
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>🏝️ Admin Panel</h2>
                <p>Wisata Sulawesi Utara</p>
            </div>
            <ul class="sidebar-menu">
                <li><a href="dashboard.php" class="active"><span class="icon">📊</span><span>Dashboard</span></a></li>
                <li><a href="wisata_manage.php"><span class="icon">🏖️</span><span>Kelola Wisata</span></a></li>
                <li><a href="kuliner_manage.php"><span class="icon">🍽️</span><span>Kelola Kuliner</span></a></li>
                <li><a href="budaya_manage.php"><span class="icon">🎭</span><span>Kelola Budaya</span></a></li>
                <li><a href="../index.php" target="_blank"><span class="icon">🌐</span><span>Lihat Website</span></a></li>
            </ul>
        </aside>

        <div class="main-content">
            <div class="top-bar">
                <div class="user-info">
                    <div class="user-avatar"><?php echo strtoupper(substr(getLoggedInUserName(), 0, 1)); ?></div>
                    <div class="user-details">
                        <h4><?php echo htmlspecialchars(getLoggedInUserName()); ?></h4>
                        <p><?php echo htmlspecialchars(ucfirst(getLoggedInUserRole())); ?></p>
                    </div>
                </div>
                <a href="../auth/logout.php" class="logout-btn">Logout</a>
            </div>

            <div class="dashboard-content">
                <div class="welcome-card">
                    <h1>Selamat Datang, <?php echo htmlspecialchars(getLoggedInUserName()); ?>! 👋</h1>
                    <p>Kelola konten wisata, kuliner, dan budaya Sulawesi Utara dengan mudah</p>
                </div>

                <h2 style="color: var(--primary); margin-bottom: 1.5rem;">Statistik Website</h2>
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon blue">🏖️</div>
                        <div class="stat-info">
                            <h3><?php echo $total_wisata; ?></h3>
                            <p>Total Wisata</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon green">🍽️</div>
                        <div class="stat-info">
                            <h3><?php echo $total_kuliner; ?></h3>
                            <p>Total Kuliner</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon orange">🎭</div>
                        <div class="stat-info">
                            <h3><?php echo $total_budaya; ?></h3>
                            <p>Total Budaya</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon purple">👤</div>
                        <div class="stat-info">
                            <h3><?php echo $total_users; ?></h3>
                            <p>Total Admin</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>