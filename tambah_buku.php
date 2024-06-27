<?php
session_start();
// Cek apakah user sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background-color: #fff;
            padding: 30px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        label {
            font-weight: bold;
        }
        input[type=text], input[type=date], input[type=number], textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        textarea {
            height: 100px;
        }
        input[type=file] {
            margin-top: 10px;
        }
        input[type=submit], input[type=button] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }
        input[type=submit]:hover, input[type=button]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Buku</h2>
        <form action="process_tambah_buku.php" method="POST" enctype="multipart/form-data">
            <label>Kode Buku:</label><br>
            <input type="text" name="kode_buku" required><br><br>
            <label>ISBN:</label><br>
            <input type="text" name="isbn" required><br><br>
            <label>Judul Buku:</label><br>
            <input type="text" name="judul_buku" required><br><br>
            <label>Pengarang:</label><br>
            <input type="text" name="pengarang" required><br><br>
            <label>Sekilas Isi:</label><br>
            <textarea name="sekilas_isi" required></textarea><br><br>
            <label>Tanggal Masuk:</label><br>
            <input type="date" name="tanggal_masuk" required><br><br>
            <label>Stok:</label><br>
            <input type="number" name="stok" required><br><br>
            <label>Foto:</label><br>
            <input type="file" name="foto" required><br><br>
            <input type="submit" value="Simpan">
            <input type="button" value="Cancel" onclick="window.location.href='index.php';">
        </form>
    </div>
</body>
</html>
