<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sti202102222";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses tambah buku
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $kode_buku = $_POST['kode_buku'];
    $isbn = $_POST['isbn'];
    $judul_buku = $_POST['judul_buku'];
    $pengarang = $_POST['pengarang'];
    $sekilas_isi = $_POST['sekilas_isi'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $stok = $_POST['stok'];

    // Upload foto buku (contoh sederhana, Anda mungkin perlu validasi dan penanganan yang lebih kompleks)
    $foto = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];
    $upload_dir = "uploads/"; // Direktori tempat menyimpan foto

    // Pindahkan foto ke direktori uploads
    move_uploaded_file($foto_tmp, $upload_dir.$foto);

    // Insert data ke database
    $sql = "INSERT INTO data_buku (kode_buku, isbn, judul_buku, pengarang, sekilas_isi, tanggal_masuk, stok, foto) 
            VALUES ('$kode_buku', '$isbn', '$judul_buku', '$pengarang', '$sekilas_isi', '$tanggal_masuk', '$stok', '$upload_dir$foto')";

    if ($conn->query($sql) === TRUE) {
        // Jika berhasil, arahkan kembali ke index.php
        header('Location: index.php');
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
