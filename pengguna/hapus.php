<?php
// File: hapus.php

// Include file koneksi.php
include '../koneksi.php';

// Cek apakah ada parameter id_pengguna yang dikirimkan melalui URL
if (isset($_GET['id_pengguna'])) {
    $idPengguna = $_GET['id_pengguna'];

    // Query SQL untuk menghapus data pengguna berdasarkan id_pengguna
    $sql = "DELETE FROM pengguna WHERE id_pengguna=$idPengguna";

    if ($conn->query($sql) === TRUE) {
        echo "Data pengguna berhasil dihapus.";
        header("Location: tampil.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Parameter id_pengguna tidak ditemukan.";
}

// Tutup koneksi ke database
$conn->close();
?>
