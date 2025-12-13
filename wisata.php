<?php
// wisata.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinasi Wisata - Wisata Sulawesi Utara</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body class="wisata-bg">
    <!-- NAVIGATION -->
    <nav>
        <div class="navbar">
            <div class="logo">
                🌴 WISATA SULUT
            </div>
            <ul class="nav-menu">
                <li class="nav-item"><a href="index.php">Beranda</a></li>
                <li class="nav-item"><a href="wisata.php" class="active">Wisata</a></li>
                <li class="nav-item"><a href="kuliner.php">Kuliner</a></li>
                <li class="nav-item"><a href="budaya.php">Budaya</a></li>
                <li class="nav-item"><a href="about.php">Tentang</a></li>
            </ul>
            <button class="nav-btn" onclick="window.location.href='auth/login.php'">Login</button>
        </div>
    </nav>

    <!-- PAGE HEADER -->
    <section class="hero" style="padding: 4rem 2rem;">
        <div class="hero-content">
            <h1>Destinasi Wisata Sulawesi Utara</h1>
            <p>Temukan keajaiban alam yang menakjubkan dan destinasi impian Anda</p>
        </div>
    </section>

    <!-- MAIN CONTENT -->
    <div class="container" style="padding: 3rem 2rem;">
        <!-- SEARCH & FILTER -->
        <div class="search-bar">
            <input type="text" class="search-input" id="searchInput" placeholder="Cari destinasi wisata...">
            <select class="filter-select" id="categoryFilter">
                <option value="">Semua Kategori</option>
                <option value="pantai">Pantai</option>
                <option value="gunung">Gunung</option>
                <option value="sejarah">Sejarah</option>
                <option value="budaya">Budaya</option>
                <option value="alam">Alam Liar</option>
            </select>
        </div>

        <!-- WISATA GRID -->
        <div class="grid grid-3" id="wisataGrid">
            <!-- Loading shimmer cards -->
            <div class="card" style="background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%); background-size: 200% 100%; animation: loading 1.5s infinite; min-height: 400px;"></div>
            <div class="card" style="background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%); background-size: 200% 100%; animation: loading 1.5s infinite; min-height: 400px;"></div>
            <div class="card" style="background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%); background-size: 200% 100%; animation: loading 1.5s infinite; min-height: 400px;"></div>
        </div>

        <!-- PAGINATION -->
        <div class="pagination" id="pagination"></div>

        <!-- NO RESULTS -->
        <div id="noResults" style="display: none; text-align: center; padding: 3rem 2rem;">
            <p style="font-size: 1.2rem; color: var(--text-light);">Tidak ada destinasi wisata yang ditemukan</p>
        </div>
    </div>

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
                <h3>Kategori</h3>
                <ul>
                    <li><a href="#" onclick="setCategory('pantai'); return false;">Pantai</a></li>
                    <li><a href="#" onclick="setCategory('gunung'); return false;">Gunung</a></li>
                    <li><a href="#" onclick="setCategory('sejarah'); return false;">Sejarah</a></li>
                    <li><a href="#" onclick="setCategory('budaya'); return false;">Budaya</a></li>
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
    <script src="js/wisata.js"></script>
</body>
</html>