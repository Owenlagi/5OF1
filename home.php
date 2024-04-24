<?php
// Memulai session
session_start();

// Periksa apakah pengguna telah masuk. Jika tidak, redirect ke halaman login.
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

// Ambil data dari form pembuatan posting
$postContent = $_POST['post-content'];
$postTime = date("Y-m-d H:i:s");

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

// Ambil username dari session
$username = $_SESSION['username'];

// Insert post ke dalam database
$sql = "INSERT INTO posts (username, content, post_time) VALUES ('$username', '$postContent', '$postTime')";

if ($conn->query($sql) === TRUE) {
    // Jika posting berhasil, redirect kembali ke halaman beranda
    header("Location: home.php");
} else {
    // Jika terjadi kesalahan, tampilkan pesan kesalahan
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
