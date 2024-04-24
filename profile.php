<?php
// Memulai session
session_start();

// Periksa apakah pengguna telah masuk. Jika tidak, redirect ke halaman login.
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

// Fungsi untuk mendapatkan data pengguna dari database
function getUserData($username, $conn) {
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

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

// Ambil data pengguna dari session
$username = $_SESSION['username'];
$userData = getUserData($username, $conn);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>User Profile</h1>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="#">Messages</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="profile-info">
            <h2><?php echo $userData['username']; ?>'s Profile</h2>
            <p><strong>Username:</strong> <?php echo $userData['username']; ?></p>
            <p><strong>Email:</strong> <?php echo $userData['email']; ?></p>
            <!-- Add more profile information here -->
        </section>
    </main>
    <footer>
        &copy; 2024 Your Social Media
    </footer>
</body>
</html>