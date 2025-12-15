<?php
// about.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Wisata Sulawesi Utara</title>
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
                <li class="nav-item"><a href="budaya.php">Budaya</a></li>
                <li class="nav-item"><a href="about.php" class="active">Tentang</a></li>
            </ul>
            <button class="nav-btn" onclick="window.location.href='auth/login.php'">Login</button>
        </div>
    </nav>

    <!-- PAGE HEADER -->
    <section class="hero" style="padding: 4rem 2rem;">
        <div class="hero-content">
            <h1>Tentang Kami</h1>
            <p>Memperkenalkan keindahan Sulawesi Utara kepada dunia</p>
        </div>
    </section>

    <!-- MAIN CONTENT -->
    <div class="container" style="padding: 3rem 2rem;">
        <!-- ABOUT SECTION -->
        <section style="margin-bottom: 4rem;">
            <div class="detail-content">
                <div class="detail-text">
                    <h2>Tentang Platform Kami</h2>
                    <p>
                        Wisata Sulawesi Utara adalah platform digital yang didedikasikan untuk mempromosikan dan 
                        memudahkan akses informasi tentang destinasi wisata, kuliner, dan budaya di Sulawesi Utara. 
                        Kami percaya bahwa setiap pengunjung berhak mendapatkan informasi yang akurat, lengkap, dan 
                        mudah dipahami.
                    </p>
                    <p>
                        Dengan database yang terus diperbarui, ulasan dari pengunjung asli, dan fitur interaktif, 
                        kami membantu Anda merencanakan perjalanan impian ke Sulawesi Utara dengan lebih baik.
                    </p>
                    <h2 style="margin-top: 2rem;">Visi & Misi</h2>
                    <p>
                        <strong>Visi:</strong> Menjadi platform wisata terpercaya yang menampilkan keindahan unik 
                        Sulawesi Utara kepada dunia.
                    </p>
                    <p style="margin-top: 1rem;">
                        <strong>Misi:</strong> Memberikan informasi wisata yang lengkap, akurat, dan interaktif 
                        untuk meningkatkan pariwisata Sulawesi Utara secara berkelanjutan.
                    </p>
                </div>

                <div class="detail-sidebar">
                    <h3 style="color: var(--primary); margin-bottom: 1.5rem;">Statistik Kami</h3>
                    
                    <div style="text-align: center; padding: 1.5rem; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); color: white; border-radius: 8px; margin-bottom: 1.5rem;">
                        <div style="font-size: 2.5rem; font-weight: 700;">50+</div>
                        <div>Destinasi Wisata</div>
                    </div>

                    <div style="text-align: center; padding: 1.5rem; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); color: white; border-radius: 8px; margin-bottom: 1.5rem;">
                        <div style="font-size: 2.5rem; font-weight: 700;">30+</div>
                        <div>Kuliner Khas</div>
                    </div>

                    <div style="text-align: center; padding: 1.5rem; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); color: white; border-radius: 8px; margin-bottom: 1.5rem;">
                        <div style="font-size: 2.5rem; font-weight: 700;">20+</div>
                        <div>Warisan Budaya</div>
                    </div>

                    <div style="text-align: center; padding: 1.5rem; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); color: white; border-radius: 8px;">
                        <div style="font-size: 2.5rem; font-weight: 700;">1K+</div>
                        <div>Pengunjung Bulanan</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FEATURES -->
        <section style="margin-bottom: 4rem;">
            <h2 class="section-title">Fitur Utama Kami</h2>
            <div class="grid grid-3" style="margin-top: 2rem;">
                <div class="card" style="text-align: center;">
                    <div style="font-size: 3rem; padding: 2rem; color: var(--primary);">🗺️</div>
                    <div class="card-body">
                        <h3 class="card-title">Peta Interaktif</h3>
                        <p class="card-text">
                            Temukan lokasi destinasi wisata secara akurat dengan peta interaktif yang mudah digunakan.
                        </p>
                    </div>
                </div>

                <div class="card" style="text-align: center;">
                    <div style="font-size: 3rem; padding: 2rem; color: var(--accent);">⭐</div>
                    <div class="card-body">
                        <h3 class="card-title">Sistem Review</h3>
                        <p class="card-text">
                            Baca review dari pengunjung lain dan bagikan pengalaman Anda untuk membantu wisatawan lain.
                        </p>
                    </div>
                </div>

                <div class="card" style="text-align: center;">
                    <div style="font-size: 3rem; padding: 2rem; color: var(--primary-light);">📸</div>
                    <div class="card-body">
                        <h3 class="card-title">Galeri Foto</h3>
                        <p class="card-text">
                            Jelajahi koleksi foto indah dari setiap destinasi untuk membantu merencanakan kunjungan Anda.
                        </p>
                    </div>
                </div>

                <div class="card" style="text-align: center;">
                    <div style="font-size: 3rem; padding: 2rem; color: var(--primary);">🍽️</div>
                    <div class="card-body">
                        <h3 class="card-title">Informasi Kuliner</h3>
                        <p class="card-text">
                            Temukan makanan khas dan restoran terbaik yang menawarkan cita rasa autentik Sulut.
                        </p>
                    </div>
                </div>

                <div class="card" style="text-align: center;">
                    <div style="font-size: 3rem; padding: 2rem; color: var(--accent);">🎭</div>
                    <div class="card-body">
                        <h3 class="card-title">Budaya & Seni</h3>
                        <p class="card-text">
                            Pelajari tradisi, adat istiadat, dan warisan budaya yang kaya dari Sulawesi Utara.
                        </p>
                    </div>
                </div>

                <div class="card" style="text-align: center;">
                    <div style="font-size: 3rem; padding: 2rem; color: var(--primary-light);">📱</div>
                    <div class="card-body">
                        <h3 class="card-title">Mobile Friendly</h3>
                        <p class="card-text">
                            Akses informasi wisata kapan saja dan di mana saja dengan website yang responsif.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- TEAM -->
        <section style="margin-bottom: 4rem; background: var(--secondary); padding: 3rem 2rem; border-radius: 12px; margin-left: -2rem; margin-right: -2rem;">
            <div style="max-width: 1200px; margin: 0 auto;">
                <h2 class="section-title">Tim Kami</h2>
                <p style="text-align: center; color: var(--text-light); margin-bottom: 2rem;">
                    Dipimpin oleh profesional berdedikasi yang memiliki passion untuk mempromosikan pariwisata Sulawesi Utara.
                </p>
                <div class="grid grid-3" style="margin-top: 2rem;">
                    <div style="text-align: center;">
                        <div style="width: 150px; height: 150px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; font-size: 3rem;">👨‍💼</div>
                        <h3 style="color: var(--primary);">Director</h3>
                        <p style="color: var(--text-light);">Memimpin visi dan misi platform</p>
                    </div>
                    <div style="text-align: center;">
                        <div style="width: 150px; height: 150px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; font-size: 3rem;">👩‍💻</div>
                        <h3 style="color: var(--primary);">Developer</h3>
                        <p style="color: var(--text-light);">Mengembangkan teknologi platform</p>
                    </div>
                    <div style="text-align: center;">
                        <div style="width: 150px; height: 150px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; font-size: 3rem;">👩‍📊</div>
                        <h3 style="color: var(--primary);">Content Manager</h3>
                        <p style="color: var(--text-light);">Mengelola konten dan informasi</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CONTACT -->
        <section>
            <h2 class="section-title">Hubungi Kami</h2>
            <div class="grid grid-2" style="margin-top: 2rem;">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">📍 Alamat</h3>
                        <p class="card-text">
                            Jl. Wisata Sulut No. 123<br>
                            Manado, Sulawesi Utara<br>
                            Indonesia 95123
                        </p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">📞 Kontak</h3>
                        <p class="card-text">
                            <strong>Telepon:</strong> +62 431 123 4567<br>
                            <strong>Email:</strong> info@wisatasulut.com<br>
                            <strong>WhatsApp:</strong> +62 812 3456 7890
                        </p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">🕐 Jam Operasional</h3>
                        <p class="card-text">
                            <strong>Senin - Jumat:</strong> 08:00 - 17:00<br>
                            <strong>Sabtu:</strong> 09:00 - 15:00<br>
                            <strong>Minggu:</strong> Tutup
                        </p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">🌐 Media Sosial</h3>
                        <p class="card-text">
                            <a href="#" style="color: var(--primary); margin-right: 1rem;">Facebook</a>
                            <a href="#" style="color: var(--primary); margin-right: 1rem;">Instagram</a>
                            <a href="#" style="color: var(--primary);">Twitter</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
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
                    <li><a href="wisata.php?category=pantai">Pantai</a></li>
                    <li><a href="wisata.php?category=gunung">Gunung</a></li>
                    <li><a href="wisata.php?category=sejarah">Sejarah</a></li>
                    <li><a href="wisata.php?category=budaya">Budaya</a></li>
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
</body>
</html>