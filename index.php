<?php
// index.php - Homepage
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wisata Sulawesi Utara</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body class="home-page">

<!-- ================= NAVBAR ================= -->
<nav>
    <div class="navbar">
        <div class="logo">🌴 WISATA SULUT</div>
        <ul class="nav-menu">
            <li class="nav-item"><a href="index.php" class="active">Beranda</a></li>
            <li class="nav-item"><a href="wisata.php">Wisata</a></li>
            <li class="nav-item"><a href="kuliner.php">Kuliner</a></li>
            <li class="nav-item"><a href="budaya.php">Budaya</a></li>
            <li class="nav-item"><a href="about.php">Tentang</a></li>
        </ul>
        <button class="nav-btn" onclick="location.href='auth/login.php'">Login</button>
    </div>
</nav>

<!-- ================= HERO ================= -->
<section class="hero">
    <div class="hero-content">
        <h1>Selamat Datang di Sulawesi Utara</h1>
        <p>Wisata alam, kuliner khas, dan budaya yang kaya</p>
        <div class="hero-btns">
            <a href="wisata.php" class="btn btn-primary">🗺️ Wisata</a>
            <a href="kuliner.php" class="btn btn-secondary">🍽️ Kuliner</a>
        </div>
    </div>
</section>

<!-- ================= WISATA PREVIEW ================= -->
<section class="container">
    <h2 class="section-title">✨ Destinasi Wisata Populer</h2>

    <div class="grid grid-3" id="wisataContainer">
        <!-- Diisi otomatis oleh home.js -->
    </div>

    <div class="center-btn">
        <a href="wisata.php" class="btn btn-primary">Lihat Semua Wisata</a>
    </div>
</section>

<!-- ================= KULINER PREVIEW ================= -->
<section class="bg-soft">
    <div class="container">
        <h2 class="section-title">🍲 Kuliner Khas</h2>

        <div class="grid grid-2" id="kulinerContainer">
            <!-- Diisi otomatis oleh home.js -->
        </div>

        <div class="center-btn">
            <a href="kuliner.php" class="btn btn-primary">Jelajahi Kuliner</a>
        </div>
    </div>
</section>

<!-- ================= BUDAYA PREVIEW ================= -->
<section class="container">
    <h2 class="section-title">🎭 Budaya Sulawesi Utara</h2>

    <div class="grid grid-3" id="budayaContainer">
        <!-- Diisi otomatis oleh home.js -->
    </div>

    <div class="center-btn">
        <a href="budaya.php" class="btn btn-primary">Pelajari Budaya</a>
    </div>
</section>

<!-- ================= FOOTER ================= -->
<footer>
    <div class="footer-content">
        <p>&copy; 2024 Wisata Sulawesi Utara</p>
    </div>
</footer>

<!-- ================= SCRIPTS ================= -->
<script src="js/main.js"></script>
<script src="js/home.js"></script>

</body>
</html>
