<?php
// Informasi koneksi ke database
$servername = "localhost"; // Ganti dengan nama host database Anda
$username = "root"; // Ganti dengan nama pengguna database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "school"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Atur karakter set koneksi ke UTF-8
mysqli_set_charset($conn, "utf8");
?>
