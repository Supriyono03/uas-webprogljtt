<?php
session_start();

// Konfigurasi koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sti202102222"; // Ganti dengan nama database Anda

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil nilai yang dikirimkan dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Melakukan query ke database untuk memeriksa user yang sesuai
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

// Memeriksa apakah query berhasil dieksekusi
if ($result) {
    // Memeriksa jumlah baris hasil query
    if ($result->num_rows == 1) {
        // Jika login berhasil
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username; // Set session username
        header('Location: index.php'); // Redirect ke halaman index.php
    } else {
        // Jika tidak ada hasil yang sesuai dengan username dan password
        echo "Login gagal. Silakan coba lagi.";
    }
} else {
    // Jika terjadi kesalahan dalam menjalankan query
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
