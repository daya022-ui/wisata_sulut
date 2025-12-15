<?php
// budaya.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budaya Sulawesi Utara - Wisata Sulawesi Utara</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- NAVIGATION -->
    <nav>
        <div class="navbar">
            <div class="logo">
                🌴 WISATA SULUT
            </div>
            <ul class="nav-menu">
                <li class="nav-item"><a href="index.php">Beranda</a></li>
                <li class="nav-item"><a href="wisata.php">Wisata</a></li>
                <li class="nav-item"><a href="kuliner.php">Kuliner</a></li>
                <li class="nav-item"><a href="budaya.php" class="active">Budaya</a></li>
                <li class="nav-item"><a href="about.php">Tentang</a></li>
            </ul>
            <button class="nav-btn" onclick="window.location.href='auth/login.php'">Login</button>
        </div>
    </nav>

    <!-- PAGE HEADER -->
    <section class="hero" style="padding: 4rem 2rem;">
        <div class="hero-content">
            <h1>🎭 Warisan Budaya Sulawesi Utara</h1>
            <p>Pelajari tradisi, seni, dan adat istiadat yang kaya dan bermakna</p>
        </div>
    </section>

    <!-- MAIN CONTENT -->
    <div class="container budaya-bg">
        <!-- SEARCH & FILTER -->
        <div class="search-bar">
            <input type="text" class="search-input" id="searchInput" placeholder="Cari budaya atau tradisi...">
            <select class="filter-select" id="categoryFilter">
                <option value="">Semua Kategori</option>
                <option value="tradisi">Tradisi</option>
                <option value="seni">Seni</option>
                <option value="adat">Adat Istiadat</option>
                <option value="upacara">Upacara</option>
            </select>
        </div>

        <!-- BUDAYA GRID -->
        <div class="grid grid-3" id="budayaGrid">
            <!-- Loading shimmer cards -->
            <div class="card" style="background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%); background-size: 200% 100%; animation: loading 1.5s infinite; min-height: 400px;"></div>
            <div class="card" style="background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%); background-size: 200% 100%; animation: loading 1.5s infinite; min-height: 400px;"></div>
        </div>

        <!-- PAGINATION -->
        <div class="pagination" id="pagination"></div>

        <!-- NO RESULTS -->
        <div id="noResults" style="display: none; text-align: center; padding: 3rem 2rem;">
            <p style="font-size: 1.2rem; color: var(--text-light);">Tidak ada budaya yang ditemukan</p>
        </div>
    </div>

    <!-- CULTURAL HIGHLIGHTS -->
    <section style="background: var(--primary); color: var(--secondary); padding: 3rem 2rem; margin: 2rem 0;">
        <div class="container">
            <h2 class="section-title" style="color: white;">Kekayaan Budaya Kami</h2>
            <div class="grid grid-3" style="margin-top: 2rem;">
                <div style="text-align: center;">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">🏛️</div>
                    <h3 style="color: var(--accent); margin-bottom: 0.5rem;">Warisan Sejarah</h3>
                    <p>Jejak peradaban yang mendalam dan berpengaruh sepanjang sejarah nusantara</p>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">🎨</div>
                    <h3 style="color: var(--accent); margin-bottom: 0.5rem;">Seni Tradisional</h3>
                    <p>Ekspresi kreatif dalam bentuk tari, musik, dan kerajinan tangan yang indah</p>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">👥</div>
                    <h3 style="color: var(--accent); margin-bottom: 0.5rem;">Masyarakat Multikultural</h3>
                    <p>Harmoni dan kebersamaan berbagai suku dalam membangun identitas lokal</p>
                </div>
            </div>
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
                <h3>Kategori Budaya</h3>
                <ul>
                    <li><a href="#" onclick="setCategory('tradisi'); return false;">Tradisi</a></li>
                    <li><a href="#" onclick="setCategory('seni'); return false;">Seni</a></li>
                    <li><a href="#" onclick="setCategory('adat'); return false;">Adat Istiadat</a></li>
                    <li><a href="#" onclick="setCategory('upacara'); return false;">Upacara</a></li>
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
    <script src="js/budaya.js"></script>
</body>
</html>