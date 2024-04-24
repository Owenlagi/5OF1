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

// Ambil data dari form pendaftaran
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Query untuk menambahkan pengguna baru
$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    // Jika pendaftaran berhasil, redirect ke halaman login
    header("Location: login.html");
} else {
    // Jika terjadi kesalahan, tampilkan pesan kesalahan
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
