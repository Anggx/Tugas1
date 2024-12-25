<?php
// Konfigurasi database
$host = 'localhost';
$dbname = 'event_universitas';
$user = 'root';
$password = '';

// Membuat koneksi ke database
$conn = new mysqli($host, $user, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Proses login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Hash password untuk mencocokkan
    $hashed_password = hash('sha256', $password);

    // Query untuk memeriksa username dan password
    $query = "SELECT * FROM users WHERE username='$username' AND password='$hashed_password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Login berhasil
        echo "<script>alert('Login Berhasil!'); window.location.href = 'index.html';</script>";
    } else {
        // Login gagal
        echo "<script>alert('Username atau Password salah!'); window.location.href = 'login.html';</script>";
    }
}

$conn->close();
?>
