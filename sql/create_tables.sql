-- Membuat Database
CREATE DATABASE IF NOT EXISTS wisata_sulut;
USE wisata_sulut;

-- Tabel Destinasi Wisata
CREATE TABLE IF NOT EXISTS destinasi_wisata (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    location VARCHAR(150) NOT NULL,
    description TEXT,
    latitude DOUBLE,
    longitude DOUBLE,
    image VARCHAR(255),
    category VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabel Kuliner
CREATE TABLE IF NOT EXISTS kuliner (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    alamat VARCHAR(255),
    latitude DOUBLE,
    longitude DOUBLE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabel Budaya
CREATE TABLE IF NOT EXISTS budaya (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    content TEXT,
    image VARCHAR(255),
    category VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabel Galeri
CREATE TABLE IF NOT EXISTS galeri_wisata (
    id INT AUTO_INCREMENT PRIMARY KEY,
    wisata_id INT,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (wisata_id) REFERENCES destinasi_wisata(id)
        ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS galeri_kuliner(
    id INT AUTO_INCREMENT PRIMARY KEY,
    kuliner_id INT NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (kuliner_id) REFERENCES kuliner(id)
        ON DELETE CASCADE
);

-- Tabel Review
CREATE TABLE IF NOT EXISTS review (
    id INT AUTO_INCREMENT PRIMARY KEY,
    wisata_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    rating INT CHECK (rating >= 1 AND rating <= 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (wisata_id) REFERENCES destinasi_wisata(id)
        ON DELETE CASCADE
);

-- Tabel Users (Admin)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'superadmin') DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Index untuk optimasi query
CREATE INDEX idx_wisata_category ON destinasi_wisata(category);
CREATE INDEX idx_budaya_category ON budaya(category);
CREATE INDEX idx_review_wisata ON review(wisata_id);
CREATE INDEX idx_galeri_wisata ON galeri_wisata(wisata_id);
CREATE INDEX idx_galeri_wisata ON galeri_kuliner(kuliner_id);
