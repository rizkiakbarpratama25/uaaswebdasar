<?php
// File: hapus.php

include '../koneksi.php';

// Cek apakah ada parameter id_siswa yang dikirimkan melalui URL
if (isset($_GET['id_siswa'])) {
    $idSiswa = $_GET['id_siswa'];

    // Query SQL untuk menghapus data siswa berdasarkan id_siswa
    $sql = "DELETE FROM siswa WHERE id_siswa=$idSiswa";

    if ($conn->query($sql) === TRUE) {
        echo "Data siswa berhasil dihapus.";
        header("Location: tampil.php");
            exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Parameter id_siswa tidak ditemukan.";
}

// Tutup koneksi ke database
$conn->close();
?>
