<?php
// kuliner.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuliner Khas - Wisata Sulawesi Utara</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="kuliner-bg">
    <!-- NAVIGATION -->
    <nav>
        <div class="navbar">
            <div class="logo">
                🌴 WISATA SULUT
            </div>
            <ul class="nav-menu">
                <li class="nav-item"><a href="index.php">Beranda</a></li>
                <li class="nav-item"><a href="wisata.php">Wisata</a></li>
                <li class="nav-item"><a href="kuliner.php" class="active">Kuliner</a></li>
                <li class="nav-item"><a href="budaya.php">Budaya</a></li>
                <li class="nav-item"><a href="about.php">Tentang</a></li>
            </ul>
            <button class="nav-btn" onclick="window.location.href='auth/login.php'">Login</button>
        </div>
    </nav>

    <!-- PAGE HEADER -->
    <section class="hero" style="padding: 4rem 2rem;">
        <div class="hero-content">
            <h1>🍲 Kuliner Khas Sulawesi Utara</h1>
            <p>Rasakan cita rasa autentik dan nikmati pengalaman kuliner yang tak terlupakan</p>
        </div>
    </section>

    <!-- MAIN CONTENT -->
    <div class="container" style="padding: 3rem 2rem;">
        <!-- SEARCH -->
        <div class="search-bar">
            <input type="text" class="search-input" id="searchInput" placeholder="Cari makanan atau restoran...">
        </div>

        <!-- KULINER GRID -->
        <div class="grid grid-2" id="kulinerGrid">
            <!-- Loading shimmer cards -->
        <div class="card" style="background: transparent; background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%); background-size: 200% 100%; animation: loading 1.5s infinite; min-height: 400px;"></div>
        <div class="card" style="background: transparent; background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%); background-size: 200% 100%; animation: loading 1.5s infinite; min-height: 400px;"></div>
        </div>

        <!-- PAGINATION -->
        <div class="pagination" id="pagination"></div>

        <!-- NO RESULTS -->
        <div id="noResults" style="display: none; text-align: center; padding: 3rem 2rem;">
            <p style="font-size: 1.2rem; color: var(--text-light);">Tidak ada kuliner yang ditemukan</p>
        </div>
    </div>

<!-- SPECIAL INFO SECTION -->
<section style="background: transparent; padding: 3rem 2rem; margin: 2rem 0;">
    <div class="container">
        <h2 class="section-title section-title-kuliner">Tentang Kuliner Sulawesi Utara</h2>
        <p style="text-align: center; color: var(--text-primary); font-size: 1.3rem; max-width: 800px; margin: 0 auto;">
            Kuliner Sulawesi Utara terkenal dengan cita rasanya yang kaya rempah dan bahan-bahan segar dari laut. 
            Setiap hidangan memiliki cerita dan warisan budaya yang mendalam. 
            Jangan lewatkan kesempatan untuk mencoba pengalaman kuliner autentik bersama kami!
        </p>
    </div>
</section>


    <!-- FOOTER -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>🌴 WISATA SULUT</h3>
                <p>Platform wisata terpercaya untuk menjelajahi keindahan Sulawesi Utara dengan panduan lengkap dan informasi akurat.</p>
                <div class="social-links">
                    <a href="#" title="Facebook">f</a>
                    <a href="#" title="Instagram">📷</a>
                    <a href="#" title="Twitter">𝕏</a>
                </div>
            </div>
            <div class="footer-section">
                <h3>Navigasi</h3>
                <ul>
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="wisata.php">Destinasi Wisata</a></li>
                    <li><a href="kuliner.php">Kuliner Lokal</a></li>
                    <li><a href="budaya.php">Budaya & Seni</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Fitur</h3>
                <ul>
                    <li><a href="#">Cari Restoran</a></li>
                    <li><a href="#">Review Kuliner</a></li>
                    <li><a href="#">Resep Tradisional</a></li>
                    <li><a href="#">Event Kuliner</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Informasi</h3>
                <ul>
                    <li><a href="about.php">Tentang Kami</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Syarat & Ketentuan</a></li>
                    <li><a href="#">Hubungi Kami</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Wisata Sulawesi Utara. Semua hak dilindungi. | Dibuat dengan ❤️ untuk keindahan Sulawesi Utara</p>
        </div>
    </footer>

    <script src="js/main.js"></script>
    <script src="js/kuliner.js"></script>
</body>
</html>