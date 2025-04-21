<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_mahasiswa";

// Koneksi awal tanpa memilih database (untuk membuat DB jika belum ada)
$conn = mysqli_connect($host, $user, $pass);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Buat database jika belum ada
mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS $db");

// Pilih database
mysqli_select_db($conn, $db);

// Buat tabel users
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
)");

// Buat tabel mahasiswa
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    nim VARCHAR(20) NOT NULL,
    jurusan VARCHAR(100) NOT NULL
)");

// Tambahkan user admin jika belum ada
$result = mysqli_query($conn, "SELECT * FROM users WHERE username = 'admin'");
if (mysqli_num_rows($result) === 0) {
    mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('admin', MD5('123'))");
}
?>
