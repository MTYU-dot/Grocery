<?php
// Mulai session
session_start();

// Cek apakah session terdaftar
if(isset($_SESSION['username'])) {
    // Session terdaftar, saatnya logout
    session_unset(); // Hapus semua variabel session
    session_destroy(); // Hapus session data
    header("Location: ../login/index.php");
    exit;
}