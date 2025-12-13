<?php
// detail_kuliner.php
$kuliner_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kuliner - Wisata Sulawesi Utara</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- LEAFLET MAP -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
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
                <li class="nav-item"><a href="kuliner.php" class="active">Kuliner</a></li>
                <li class="nav-item"><a href="budaya.php">Budaya</a></li>
                <li class="nav-item"><a href="about.php">Tentang</a></li>
            </ul>
            <button class="nav-btn" onclick="window.location.href='auth/login.php'">Login</button>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="detail-hero">
        <div class="container">
            <div style="margin-bottom: 1rem;">
                <a href="kuliner.php" style="color: var(--secondary); text-decoration: underline;">← Kembali ke Kuliner</a>
            </div>
            <div id="detailLoading" style="display: flex; align-items: center; justify-content: center; height: 300px;">
                <span class="loading" style="border-color: white; border-top-color: var(--accent);"></span>
            </div>
            <div id="detailContent" style="display: none;">
                <div style="text-align: center;">
                    <h1 id="detailTitle" style="font-size: 2.5rem; margin-bottom: 0.5rem;"></h1>
                    <p id="detailAlamat" style="font-size: 1.1rem; opacity: 0.9;"></p>
                </div>
                <img id="detailImage" src="" alt="" style="width: 100%; max-height: 500px; object-fit: cover; border-radius: 12px; margin-top: 2rem; box-shadow: var(--shadow-lg);">
            </div>
        </div>
    </section>

    <!-- DETAIL CONTENT -->
    <div class="container" style="padding: 3rem 2rem;">
        <div id="contentLoading" style="display: flex; align-items: center; justify-content: center; height: 300px;">
            <span class="loading" style="border-color: var(--primary);"></span>
        </div>

        <div id="contentDetail" style="display: none;">
            <div class="detail-content">
                <div class="detail-text">
                    <h2>Deskripsi</h2>
                    <p id="detailDescription"></p>
                    
                    <h2 style="margin-top: 2rem;">📍 Lokasi</h2>
                    <div id="mapContainer" style="width: 100%; height: 400px; border-radius: 12px; background: var(--secondary); margin: 1rem 0; display: flex; align-items: center; justify-content: center;">
                        <p style="color: var(--text-light);">Peta sedang dimuat...</p>
                    </div>
                </div>

                <div class="detail-sidebar">
                    <h3 style="color: var(--primary); margin-bottom: 1.5rem;">📋 Informasi Kuliner</h3>
                    
                    <div class="info-item">
                        <strong>🍽️ Nama Makanan:</strong>
                        <span id="sidebarName"></span>
                    </div>

                    <div class="info-item">
                        <strong>📍 Alamat:</strong>
                        <span id="sidebarAlamat"></span>
                    </div>

                    <div class="info-item">
                        <strong>🌐 Koordinat:</strong>
                        <div id="sidebarCoordinates" style="margin-top: 0.5rem; font-size: 0.9rem;">
                            <div>Latitude: <span id="latValue"></span></div>
                            <div>Longitude: <span id="lngValue"></span></div>
                        </div>
                    </div>

                    <button class="btn btn-primary" style="width: 100%; margin-top: 1.5rem;" onclick="openInGoogleMaps()">
                        🗺️ Buka di Google Maps
                    </button>
                </div>
            </div>

            <!-- GALERI -->
            <section style="margin-top: 3rem;">
                <h2 class="section-title">📸 Galeri Foto Kuliner</h2>
                <div class="gallery" id="galleryContainer">
                    <p style="text-align: center; color: var(--text-light);">Galeri sedang dimuat...</p>
                </div>
            </section>
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
                    <li><a href="wisata.php?category=pantai">🏖️ Pantai</a></li>
                    <li><a href="wisata.php?category=gunung">⛰️ Gunung</a></li>
                    <li><a href="wisata.php?category=sejarah">🏛️ Sejarah</a></li>
                    <li><a href="wisata.php?category=budaya">🎭 Budaya</a></li>
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

    <!-- LEAFLET MAP -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    
    <script src="js/main.js"></script>
    
    <script src="js/map.js"></script>

    <script src="js/detail_kuliner.js"></script>
    

</body>
</html>