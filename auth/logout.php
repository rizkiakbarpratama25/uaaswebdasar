<?php
session_start();

// Hapus sesi
session_unset();
session_destroy();

// Redirect ke halaman utama
header("Location: login.php");
exit();
?>
