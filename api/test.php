<?php
$conn = new mysqli("localhost", "root", "", "wisata_sulut");

if ($conn->connect_error) {
    die("Error: " . $conn->connect_error);
}

echo "Koneksi berhasil!";
?>
