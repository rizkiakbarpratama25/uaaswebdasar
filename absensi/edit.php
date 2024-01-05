<?php
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idAbsensi = mysqli_real_escape_string($conn, $_POST["id_absensi"]);
    $idSiswa = mysqli_real_escape_string($conn, $_POST["id_siswa"]);
    $tanggal = mysqli_real_escape_string($conn, $_POST["tanggal"]);
    $kehadiran = mysqli_real_escape_string($conn, $_POST["kehadiran"]);
    $keterangan = mysqli_real_escape_string($conn, $_POST["keterangan"]);
    $mataPelajaran = mysqli_real_escape_string($conn, $_POST["mata_pelajaran"]);
    $nilai = mysqli_real_escape_string($conn, $_POST["nilai"]);

    $stmt = $conn->prepare("UPDATE absensi SET id_siswa=?, tanggal=?, kehadiran=?, keterangan=?, mata_pelajaran=?, nilai=? WHERE id_absensi=?");
    $stmt->bind_param("issisii", $idSiswa, $tanggal, $kehadiran, $keterangan, $mataPelajaran, $nilai, $idAbsensi);

    if ($stmt->execute()) {
        echo "Data absensi berhasil diperbarui.";
        header("Location: tampil.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

if (isset($_GET['id_absensi'])) {
    $idAbsensi = $_GET['id_absensi'];

    $sqlGetData = "SELECT * FROM absensi WHERE id_absensi = $idAbsensi";
    $resultGetData = $conn->query($sqlGetData);

    if ($resultGetData->num_rows > 0) {
        $dataAbsensi = $resultGetData->fetch_assoc();
    } else {
        echo "Data absensi tidak ditemukan.";
        exit();
    }
} else {
    echo "Parameter id_absensi tidak ditemukan.";
    exit();
}

// Ambil data dari tabel siswa untuk dropdown
$sqlSiswa = "SELECT id_siswa, nama_siswa FROM siswa";
$resultSiswa = $conn->query($sqlSiswa);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Absensi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Data Absensi</h2>

    <form method="post" action="">
        <input type="hidden" name="id_absensi" value="<?php echo $dataAbsensi['id_absensi']; ?>">

        <div class="form-group">
            <label for="id_siswa">ID Siswa:</label>
            <select class="form-control" name="id_siswa" required>
                <?php
                while ($rowSiswa = $resultSiswa->fetch_assoc()) {
                    $selected = ($rowSiswa['id_siswa'] == $dataAbsensi['id_siswa']) ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars($rowSiswa['id_siswa']) . "' $selected>" . htmlspecialchars($rowSiswa['id_siswa']) . " - " . htmlspecialchars($rowSiswa['nama_siswa']) . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="tanggal">Tanggal:</label>
            <input type="date" class="form-control" name="tanggal" value="<?php echo $dataAbsensi['tanggal']; ?>" required>
        </div>

        <div class="form-group">
            <label for="kehadiran">Kehadiran:</label>
            <select class="form-control" name="kehadiran" required>
                <option value="1" <?php echo ($dataAbsensi['kehadiran'] == 1) ? 'selected' : ''; ?>>Hadir</option>
                <option value="0" <?php echo ($dataAbsensi['kehadiran'] == 0) ? 'selected' : ''; ?>>Tidak Hadir</option>
            </select>
        </div>

        <div class="form-group">
            <label for="keterangan">Keterangan:</label>
            <textarea class="form-control" name="keterangan"><?php echo $dataAbsensi['keterangan']; ?></textarea>
        </div>

        <div class="form-group">
            <label for="mata_pelajaran">Mata Pelajaran:</label>
            <input type="text" class="form-control" name="mata_pelajaran" value="<?php echo $dataAbsensi['mata_pelajaran']; ?>" required>
        </div>

        <div class="form-group">
            <label for="nilai">Nilai:</label>
            <input type="number" class="form-control" name="nilai" value="<?php echo $dataAbsensi['nilai']; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Absensi</button>
        <a href="read.php" class="btn btn-danger">Cancel</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
