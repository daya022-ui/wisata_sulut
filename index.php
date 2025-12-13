<?php
// index.php - Homepage
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wisata Sulawesi Utara - Jelajahi Keindahan Alam & Budaya</title>
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
                <li class="nav-item"><a href="index.php" class="active">Beranda</a></li>
                <li class="nav-item"><a href="wisata.php">Wisata</a></li>
                <li class="nav-item"><a href="kuliner.php">Kuliner</a></li>
                <li class="nav-item"><a href="budaya.php">Budaya</a></li>
                <li class="nav-item"><a href="about.php">Tentang</a></li>
            </ul>
            <button class="nav-btn" onclick="window.location.href='auth/login.php'">Login</button>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero">
        <div class="hero-content">
            <h1>Selamat Datang di Sulawesi Utara</h1>
            <p>Jelajahi keindahan alam yang memukau, kuliner lezat, dan budaya kaya yang menakjubkan</p>
            <div class="hero-btns">
                <a href="wisata.php" class="btn btn-primary">🗺️ Jelajahi Wisata</a>
                <a href="kuliner.php" class="btn btn-secondary">🍽️ Coba Kuliner</a>
            </div>
        </div>
    </section>

    <!-- WISATA PREVIEW -->
    <section class="container">
        <h2 class="section-title">✨ Destinasi Wisata Populer</h2>
        <div class="grid grid-3" id="wisataContainer">
            <!-- Fallback cards jika JS tidak berjalan -->
            <div class="card fade-in">
                <img src="https://via.placeholder.com/300x250/1a5f3f/ffffff?text=Pantai+Bunaken" alt="Pantai Bunaken" class="card-img">
                <div class="card-body">
                    <span class="card-badge">Pantai</span>
                    <h3 class="card-title">Pantai Bunaken</h3>
                    <p class="card-text">Destinasi diving terbaik di Indonesia dengan terumbu karang yang memukau dan keanekaragaman hayati laut yang luar biasa.</p>
                    <div class="card-footer">
                        <div>
                            <div class="card-rating"><span class="star">★★★★★</span></div>
                            <small style="color: var(--text-light);">245 review</small>
                        </div>
                        <small style="color: var(--text-light);">📍 Manado</small>
                    </div>
                </div>
            </div>

            <div class="card fade-in">
                <img src="https://via.placeholder.com/300x250/1a5f3f/ffffff?text=Gunung+Lokon" alt="Gunung Lokon" class="card-img">
                <div class="card-body">
                    <span class="card-badge">Gunung</span>
                    <h3 class="card-title">Gunung Lokon</h3>
                    <p class="card-text">Gunung berapi yang masih aktif dengan pemandangan spektakuler dari puncaknya. Cocok untuk para pendaki profesional maupun pemula.</p>
                    <div class="card-footer">
                        <div>
                            <div class="card-rating"><span class="star">★★★★☆</span></div>
                            <small style="color: var(--text-light);">189 review</small>
                        </div>
                        <small style="color: var(--text-light);">📍 Tomohon</small>
                    </div>
                </div>
            </div>

            <div class="card fade-in">
                <img src="https://via.placeholder.com/300x250/1a5f3f/ffffff?text=Taman+Laut" alt="Taman Laut" class="card-img">
                <div class="card-body">
                    <span class="card-badge">Alam</span>
                    <h3 class="card-title">Taman Laut Bit</h3>
                    <p class="card-text">Kawasan konservasi laut yang kaya akan kehidupan bawah laut. Tempat sempurna untuk snorkeling dan photography bawah laut.</p>
                    <div class="card-footer">
                        <div>
                            <div class="card-rating"><span class="star">★★★★★</span></div>
                            <small style="color: var(--text-light);">312 review</small>
                        </div>
                        <small style="color: var(--text-light);">📍 Bitung</small>
                    </div>
                </div>
            </div>
        </div>
        <div style="text-align: center; margin-top: 2rem;">
            <a href="wisata.php" class="btn btn-primary">Lihat Semua Wisata →</a>
        </div>
    </section>

    <!-- KULINER PREVIEW -->
    <section style="background: var(--secondary); padding: 4rem 2rem; margin: 2rem 0;">
        <div class="container">
            <h2 class="section-title">🍲 Kuliner Khas Sulawesi Utara</h2>
            <div class="grid grid-2" id="kulinerContainer">
                <!-- Fallback cards -->
                <div class="card fade-in">
                    <img src="https://via.placeholder.com/300x250/1a5f3f/ffffff?text=Cakalang+Fufu" alt="Cakalang Fufu" class="card-img">
                    <div class="card-body">
                        <h3 class="card-title">Cakalang Fufu</h3>
                        <p class="card-text">Makanan khas Manado berupa daging babi yang diasinkan dan dikeringkan. Teksturnya unik dan rasa gurih yang autentik dari budaya lokal.</p>
                        <div class="card-footer">
                            <div>
                                <small style="color: var(--text-light);">🏪 Restoran Tradisional</small>
                            </div>
                            <small style="color: var(--text-light);">📍 Manado</small>
                        </div>
                    </div>
                </div>

                <div class="card fade-in">
                    <img src="https://via.placeholder.com/300x250/1a5f3f/ffffff?text=Tinutuan" alt="Tinutuan" class="card-img">
                    <div class="card-body">
                        <h3 class="card-title">Tinutuan</h3>
                        <p class="card-text">Bubur tradisional Manado yang kaya rempah dengan tambahan ikan atau telur. Sarapan favorit masyarakat lokal yang sangat bergizi dan lezat.</p>
                        <div class="card-footer">
                            <div>
                                <small style="color: var(--text-light);">🏪 Warung Pagi</small>
                            </div>
                            <small style="color: var(--text-light);">📍 Manado</small>
                        </div>
                    </div>
                </div>
            </div>
            <div style="text-align: center; margin-top: 2rem;">
                <a href="kuliner.php" class="btn btn-primary">Jelajahi Kuliner →</a>
            </div>
        </div>
    </section>

    <!-- BUDAYA PREVIEW -->
    <section class="container">
        <h2 class="section-title">🎭 Warisan Budaya Sulawesi Utara</h2>
        <div class="grid grid-3" id="budayaContainer">
            <!-- Fallback cards -->
            <div class="card fade-in">
                <img src="https://via.placeholder.com/300x250/1a5f3f/ffffff?text=Tari+Cakalele" alt="Tari Cakalele" class="card-img">
                <div class="card-body">
                    <span class="card-badge">Seni</span>
                    <h3 class="card-title">Tari Cakalele</h3>
                    <p class="card-text">Tarian tradisional perang dari Maluku Utara yang penuh energi dan dinamika. Gerakan yang lincah mencerminkan semangat prajurit...</p>
                    <div class="card-footer">
                        <a href="#" style="color: var(--primary); font-weight: 600;">Baca Selengkapnya →</a>
                    </div>
                </div>
            </div>

            <div class="card fade-in">
                <img src="https://via.placeholder.com/300x250/1a5f3f/ffffff?text=Upacara+Adat" alt="Upacara Adat" class="card-img">
                <div class="card-body">
                    <span class="card-badge">Tradisi</span>
                    <h3 class="card-title">Upacara Adat Minahasa</h3>
                    <p class="card-text">Rangkaian upacara tradisional masyarakat Minahasa untuk berbagai acara penting. Setiap upacara memiliki makna dan filosofi mendalam...</p>
                    <div class="card-footer">
                        <a href="#" style="color: var(--primary); font-weight: 600;">Baca Selengkapnya →</a>
                    </div>
                </div>
            </div>

            <div class="card fade-in">
                <img src="https://via.placeholder.com/300x250/1a5f3f/ffffff?text=Kerajinan+Tangan" alt="Kerajinan Tangan" class="card-img">
                <div class="card-body">
                    <span class="card-badge">Seni</span>
                    <h3 class="card-title">Kerajinan Tangan Lokal</h3>
                    <p class="card-text">Produk kerajinan tangan khas yang dibuat oleh pengrajin lokal dengan teknik tradisional. Setiap produk memiliki karakter dan keunikan tersendiri...</p>
                    <div class="card-footer">
                        <a href="#" style="color: var(--primary); font-weight: 600;">Baca Selengkapnya →</a>
                    </div>
                </div>
            </div>
        </div>
        <div style="text-align: center; margin-top: 2rem;">
            <a href="budaya.php" class="btn btn-primary">Pelajari Budaya →</a>
        </div>
    </section>

    <!-- INFO SECTION -->
    <section style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); color: var(--secondary); padding: 3rem 2rem;">
        <div class="container">
            <div style="text-align: center; margin-bottom: 3rem;">
                <h2 class="section-title" style="color: white;">Kenapa Memilih Kami?</h2>
            </div>
            <div class="grid grid-3">
                <div style="text-align: center;">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">📍</div>
                    <h3 style="color: var(--accent); margin-bottom: 0.5rem; font-size: 1.3rem;">Informasi Lengkap</h3>
                    <p>Database destinasi wisata terlengkap dengan informasi detail dan akurat untuk setiap lokasi.</p>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">⭐</div>
                    <h3 style="color: var(--accent); margin-bottom: 0.5rem; font-size: 1.3rem;">Review Asli</h3>
                    <p>Review dari pengunjung nyata yang membantu Anda membuat keputusan terbaik untuk liburan.</p>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">🗺️</div>
                    <h3 style="color: var(--accent); margin-bottom: 0.5rem; font-size: 1.3rem;">Peta Interaktif</h3>
                    <p>Temukan lokasi dengan mudah menggunakan peta interaktif kami yang user-friendly.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>🌴 WISATA SULUT</h3>
                <p>Platform wisata terpercaya untuk menjelajahi keindahan Sulawesi Utara dengan panduan lengkap dan informasi akurat yang kami sediakan.</p>
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
                <h3>Kategori Wisata</h3>
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

    <script src="js/main.js"></script>
    <script src="js/wisata.js"></script>
    <script src="js/kuliner.js"></script>
    <script src="js/budaya.js"></script>
</body>
</html>