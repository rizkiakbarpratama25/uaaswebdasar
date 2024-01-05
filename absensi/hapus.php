<?php
// File: hapus.php

include '../koneksi.php';

// Cek apakah ada parameter id_absensi yang dikirimkan melalui URL
if (isset($_GET['id_absensi'])) {
    $idAbsensi = $_GET['id_absensi'];

    // Query SQL untuk menghapus data absensi berdasarkan id_absensi
    $sql = "DELETE FROM absensi WHERE id_absensi = $idAbsensi";

    if ($conn->query($sql) === TRUE) {
        echo "Data absensi berhasil dihapus.";
        header("Location: tampil.php");
            exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Parameter id_absensi tidak ditemukan.";
}

// Tutup koneksi ke database
$conn->close();
?>
