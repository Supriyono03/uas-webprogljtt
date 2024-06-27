<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Koneksi ke database (ganti dengan konfigurasi koneksi Anda)
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "sti202102222"; // Ganti dengan nama database Anda

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID buku yang akan dihapus
$id = $_GET['id'];

// Query SQL untuk menghapus data buku dari database
$sql = "DELETE FROM data_buku WHERE id = ?";

// Persiapkan statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

// Eksekusi statement
if ($stmt->execute()) {
    // Jika berhasil dihapus, arahkan kembali ke index.php
    header('Location: index.php');
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
