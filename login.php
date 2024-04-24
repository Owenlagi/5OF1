<?php
// Koneksi ke database
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "social_media";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk memeriksa kecocokan username dan password
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

// Periksa hasil query
if ($result->num_rows > 0) {
    // Jika data ditemukan, redirect ke halaman home
    header("Location: home.php");
} else {
    // Jika data tidak ditemukan, kembali ke halaman login
    header("Location: login.html");
}

$conn->close();
?>