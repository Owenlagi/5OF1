<?php
// Memulai session
session_start();

// Periksa apakah pengguna telah masuk. Jika tidak, redirect ke halaman login.
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
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

// Ambil username dari session
$username = $_SESSION['username'];

// Query untuk mengambil pesan
$sql = "SELECT * FROM messages WHERE receiver='$username'";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Your Messages</h1>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="#">Messages</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="messages">
            <h2>Inbox</h2>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='message'>";
                    echo "<p><strong>From:</strong> " . $row['sender'] . "</p>";
                    echo "<p><strong>Message:</strong> " . $row['message'] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No messages.</p>";
            }
            ?>
        </section>
    </main>
    <footer>
        &copy; 2024 Your Social Media
    </footer>
</body>
</html>
