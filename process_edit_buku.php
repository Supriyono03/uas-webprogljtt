<?php
session_start();

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

// Ambil data dari form edit buku
$id = $_POST['id'];
$kode_buku = $_POST['kode_buku'];
$isbn = $_POST['isbn'];
$judul_buku = $_POST['judul_buku'];
$pengarang = $_POST['pengarang'];
$sekilas_isi = $_POST['sekilas_isi'];
$tanggal_masuk = $_POST['tanggal_masuk'];
$stok = $_POST['stok'];

// Query SQL untuk update data buku ke database
$sql = "UPDATE data_buku SET
        kode_buku = '$kode_buku',
        isbn = '$isbn',
        judul_buku = '$judul_buku',
        pengarang = '$pengarang',
        sekilas_isi = '$sekilas_isi',
        tanggal_masuk = '$tanggal_masuk',
        stok = '$stok'
        WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Data buku berhasil diupdate.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
