-- ============================================
-- INSERT DATA DESTINASI WISATA SULAWESI UTARA
-- ============================================

USE wisata_sulut;

-- Hapus data lama (opsional)
-- DELETE FROM destinasi_wisata;

-- Insert Data Wisata
INSERT INTO destinasi_wisata
(name, location, description, latitude, longitude, image, category)
VALUES
    ('Bunaken National Marine Park (Pulau Bunaken)', 'Perairan Bunaken, Wori, Sulawesi Utara (Akses dari Pelabuhan Manado)', 'Taman Nasional Laut terkenal dunia, kaya akan terumbu karang dan biota laut yang spektakuler. Cocok untuk diving dan snorkeling.', 1.6232280672368284, 124.76489780251732, 'bunaken1.png', 'Taman Laut'),
    ('Pantai Paal', 'Desa Marinsow, Kecamatan Likupang Timur, Kabupaten Minahasa Utara, Sulawesi Utara.', 'Pantai berpasir putih dengan air laut biru jernih, dikelilingi perbukitan hijau. Populer karena pemandangannya yang indah dan cocok untuk bersantai.', 1.650833, 125.043611, 'paal1.png', 'Pantai'),
    ('Danau Linow', 'Desa Lahendong, Kecamatan Tomohon Selatan, Kota Tomohon, Sulawesi Utara.', 'Danau kawah yang unik dengan air yang dapat berubah warna (hijau, biru, kuning) karena kandungan belerang. Terdapat kafe/restoran di sekitar untuk menikmati pemandangan.', 1.270, 124.827, 'linow1.png', 'Danau Kawah'),
    ('Taman Kelong', 'Jl. Mahawu, Kakaskasen Dua, Kec. Tomohon Utara, Kota Tomohon, Sulawesi Utara.', 'Tempat makan dan rekreasi dengan konsep taman di Tomohon. Menawarkan pemandangan pegunungan dan suasana yang sejuk.', 1.346806, 124.842778, 'kelong1.png', 'Taman & Rekreasi'),
    ('Taman Nasional Tangkoko Batuangus', 'Kota Bitung, sekitar satu jam dari Manado, Sulawesi Utara.', 'Cagar alam yang menjadi rumah bagi satwa endemik langka seperti Tarsius Spektral (primata terkecil di dunia), Yaki (monyet hitam Sulawesi), dan Burung Rangkong.', 1.540833, 125.179444, 'batuangus1.png', 'Taman Nasional'),
    ('Puncak Tetetana Kumelembuai', 'Kumelembuay, Kec. Tomohon Timur, Kabupaten Minahasa, Sulawesi Utara.', 'Titik pandang populer untuk menikmati panorama pegunungan, Kota Tomohon, dan Danau Tondano dari ketinggian. Sering digunakan sebagai lokasi foto yang indah.', 1.291667, 124.856667, 'tetetana1.png', 'Puncak/Viewpoint'),
    ('Bukit Kasih Kanonang', 'Jl. Kawangkoan-Kanonang, Kanonang Empat, Kec. Kawangkoan Bar., Kabupaten Minahasa, Sulawesi Utara.', 'Bukit religi dan toleransi yang memiliki lima rumah ibadah (gereja, pura, vihara, masjid, sinagoge) di bawah satu kompleks. Pemandangan alam yang indah dengan tangga menuju puncak.', 1.200336, 124.789613, 'kanonang1.png', 'Wisata Religi/Alam'),
    ('Amole Hill', 'Woloan Satu Utara, Tomohon Barat, Kota Tomohon, Sulawesi Utara.', 'Salah satu destinasi wisata di Tomohon yang menawarkan pemandangan alam dan cocok untuk kegiatan rekreasi keluarga.', 1.309028, 124.819722, 'amole1.png', 'Bukit Rekreasi'),
    ('Astound Hill', 'Jl. Raya Tondano - Remboken, Peleloan, Tondano Selatan, Kabupaten Minahasa, Sulawesi Utara.', 'Destinasi rekreasi berupa restoran/kafe dengan pemandangan langsung ke Danau Tondano. Populer untuk bersantai sambil menikmati kuliner.', 1.238611, 124.896944, 'astound1.png', 'Restoran/Kafe View'),
    ('Puncak Toulangkow', 'Lahendong, Kec. Tomohon Selatan, Kota Tomohon, Sulawesi Utara.', 'Kawasan perbukitan di sekitar Tomohon yang menawarkan pemandangan Danau Linow dan alam sekitar. Seringkali menjadi tempat selfie atau berkumpul.', 1.282778, 124.836111, 'toulangkow1.png', 'Puncak/Viewpoint'),
    ('Kilapong Hill', 'Kaki Gunung Mahawu. Kota Tomohon, Sulawesi Utara.', 'Terletak di kaki Gunung Mahawu, Tomohon, Kilapong Hill adalah tempat wisata yang menawarkan pemandangan alam yang indah dan penataan taman yang estetik.', 1.332500, 124.869722, 'kilapong1.png', 'Bukit/Taman'),
    ('Gardenia', 'Jl. Kawiley, Kakaskasen 2, Kecamatan Tomohon Utara, Kota Tomohon, Sulawesi Utara.', 'Wisata taman bunga dan penginapan di Tomohon, lengkap dengan restoran/kafe yang menyuguhkan pemandangan alam sejuk.', 1.331572, 124.832714, 'gardenia1.png', 'Taman Bunga'),
    ('Narwastu Hills', 'Jl. Wawo, Matani III, Kecamatan Tomohon Tengah, Kota Tomohon, Sulawesi Utara.', 'Wisata bukit terbaru di Kota Tomohon dengan pemandangan kota dan gunung yang memukau, banyak spot foto dan aktivitas santai.', 1.319722, 124.851111, 'narwastu1.png', 'Bukit Rekreasi'),
    ('Rumah Alam', 'Jl. Ring Road Jaga IX No.Km, RW.1, Maumbi, Kec. Kalawat, Kabupaten Minahasa Utara, Sulawesi Utara.', 'Tempat rekreasi outdoor di Manado yang menyediakan berbagai wahana seperti ATV, flying fox, kolam renang alami, mini zoo, dan lainnya yang cocok untuk keluarga.', 1.423056, 124.908056, 'alam1.png', 'Rekreasi Outdoor'),
    ('Danau Tondano', 'Kabupaten Minahasa, Sulawesi Utara (sekitar Tondano).', 'Danau besar di Kabupaten Minahasa, Sulawesi Utara, yang menjadi destinasi alam populer dengan suasana tenang dan panorama menarik.', 1.225, 124.900, 'tondano1.png', 'Danau Alam'),
    ('Taman Wisata Mahoni', 'Kakaskasen Tiga, Kec. Tomohon Utara, Kota Tomohon, Sulawesi Utara.', 'Tempat rekreasi luar ruangan dan wisata yang mengandalkan taman bunga yang indah.', 1.336111, 124.848333, 'mahoni1.png', 'Taman Bunga'),
    ('Sumaru Endo', 'Desa Leleko, Kecamatan Remboken, Kabupaten Minahasa, Sulawesi Utara.', 'Resor dan tempat rekreasi keluarga di tepi Danau Tondano, terkenal dengan kolam renang air panas alami dan penginapan.', 1.233333, 124.888889, 'sumaru1.jpg', 'Resor/Kolam Air Panas'),
    ('Malalayang Beach Walk', 'Jl. Wolter Monginsidi No.83, Malalayang Dua, Kec. Malalayang, Kota Manado, Sulawesi Utara.', 'Ruang publik dan kawasan pantai yang telah direvitalisasi di Manado. Tempat yang populer untuk bersantai sore, berolahraga, atau menikmati matahari terbenam.', 1.454848, 124.817203, 'malalayang1.png', 'Ruang Publik/Pantai'),
    ('Pulau Siladen', 'Di sebelah timur laut Pulau Bunaken, Sulawesi Utara. Diakses dengan kapal dari Manado', 'Pulau kecil di dekat Bunaken yang terkenal dengan pantai berpasir putih dan titik menyelam/snorkeling yang indah. Merupakan bagian dari Taman Nasional Bunaken.', 1.631667, 124.8025, 'siladen1.png', 'Pulau/Taman Laut'),
    ('Pulau Naiin', 'Dekat Pulau Bunaken, Teluk Manado, Sulawesi Utara.', 'Pulau lain di sekitar Bunaken (bagian dari TN Bunaken). Menawarkan pemandangan unik dengan bentukan daratan yang menjorok seperti gunung kecil yang muncul dari laut.', 1.636944, 124.739722, 'nain1.png', 'Pulau/Taman Laut');


-- ============================================
-- VERIFIKASI DATA
-- ============================================
SELECT COUNT(*) as total_wisata FROM destinasi_wisata;

SELECT * FROM destinasi_wisata LIMIT 5;