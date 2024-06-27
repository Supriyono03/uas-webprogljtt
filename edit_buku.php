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

// Ambil ID buku yang akan diedit
$id = $_GET['id'];

// Query SQL untuk mengambil data buku berdasarkan ID
$sql = "SELECT * FROM data_buku WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Data buku tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 20px;
        }
        .container {
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: auto;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"],
        input[type="date"],
        textarea {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        textarea {
            height: 100px;
            resize: vertical;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .cancel-btn {
            background-color: #ccc;
            color: #333;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
        }
        .cancel-btn:hover {
            background-color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Buku</h2>
        <form action="process_edit_buku.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            
            <label for="kode_buku">Kode Buku:</label>
            <input type="text" id="kode_buku" name="kode_buku" value="<?php echo htmlspecialchars($row['kode_buku']); ?>"><br><br>
            
            <label for="isbn">ISBN:</label>
            <input type="text" id="isbn" name="isbn" value="<?php echo htmlspecialchars($row['isbn']); ?>"><br><br>
            
            <label for="judul_buku">Judul Buku:</label>
            <input type="text" id="judul_buku" name="judul_buku" value="<?php echo htmlspecialchars($row['judul_buku']); ?>"><br><br>
            
            <label for="pengarang">Pengarang:</label>
            <input type="text" id="pengarang" name="pengarang" value="<?php echo htmlspecialchars($row['pengarang']); ?>"><br><br>
            
            <label for="sekilas_isi">Sekilas Isi:</label>
            <textarea id="sekilas_isi" name="sekilas_isi"><?php echo htmlspecialchars($row['sekilas_isi']); ?></textarea><br><br>
            
            <label for="tanggal_masuk">Tanggal Masuk:</label>
            <input type="date" id="tanggal_masuk" name="tanggal_masuk" value="<?php echo htmlspecialchars($row['tanggal_masuk']); ?>"><br><br>
            
            <label for="stok">Stok:</label>
            <input type="number" id="stok" name="stok" value="<?php echo htmlspecialchars($row['stok']); ?>"><br><br>
            
            <input type="submit" value="Simpan">
            <a href="index.php" class="cancel-btn">Cancel</a>
        </form>
    </div>
</body>
</html>
