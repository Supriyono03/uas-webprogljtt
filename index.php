<?php
session_start();

// Cek apakah pengguna sudah login, jika tidak redirect ke halaman login.php
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

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Pagination
$limit = 10; // Jumlah data per halaman
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Query untuk mengambil data dengan limit dan offset
$sql = "SELECT id, kode_buku, isbn, judul_buku, pengarang, sekilas_isi, tanggal_masuk, stok, foto 
        FROM data_buku 
        LIMIT $offset, $limit";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Perpustakaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }
        h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .action-links a {
            margin-right: 10px;
            text-decoration: none;
            color: #007bff;
        }
        .action-links a:hover {
            text-decoration: underline;
        }
        .book-thumbnail {
            max-width: 100px; /* Atur ukuran gambar sesuai kebutuhan */
            max-height: 100px;
        }
        .pagination {
            margin-top: 10px;
        }
        .pagination a {
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            margin-right: 5px;
            border-radius: 5px;
            text-decoration: none;
        }
        .pagination a:hover {
            background-color: #0056b3;
        }
        .success-message {
            background-color: #28a745;
            color: white;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }
        .warning-message {
            background-color: #dc3545;
            color: white;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }
        @media only screen and (max-width: 600px) {
            table {
                font-size: 14px;
            }
            .book-thumbnail {
                max-width: 50px;
                max-height: 50px;
            }
        }
    </style>
</head>
<body>
    <h2>Daftar Buku Perpustakaan</h2>
    <a href="tambah_buku.php" style="text-decoration: none; background-color: #007bff; color: white; padding: 10px 15px; border-radius: 5px;">Tambah Buku</a>
    <a href="logout.php" style="text-decoration: none; background-color: #dc3545; color: white; padding: 10px 15px; border-radius: 5px; margin-left: 10px;">Keluar</a>
    <br><br>

    <?php
    if ($result && $result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Kode Buku</th>
                    <th>ISBN</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Sekilas Isi</th>
                    <th>Tanggal Masuk</th>
                    <th>Stok</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["id"]."</td>
                    <td>".$row["kode_buku"]."</td>
                    <td>".$row["isbn"]."</td>
                    <td>".$row["judul_buku"]."</td>
                    <td>".$row["pengarang"]."</td>
                    <td>".$row["sekilas_isi"]."</td>
                    <td>".$row["tanggal_masuk"]."</td>
                    <td>".$row["stok"]."</td>
                    <td><img src='".$row["foto"]."' alt='Foto Buku' class='book-thumbnail'></td>
                    <td class='action-links'>
                        <a href='edit_buku.php?id=".$row["id"]."'>Edit</a>
                        <a href='hapus_buku.php?id=".$row["id"]."'>Hapus</a>
                    </td>
                </tr>";
        }
        echo "</table>";

        // Tampilkan link pagination di bagian bawah tabel
        echo "<div class='pagination'>";
        $sql_total = "SELECT COUNT(id) AS total FROM data_buku";
        $result_total = $conn->query($sql_total);
        $row_total = $result_total->fetch_assoc();
        $total_pages = ceil($row_total['total'] / $limit);

        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='index.php?page=$i'>$i</a>";
        }
        echo "</div>";

    } else {
        echo "<div class='warning-message'>Tidak ada data buku.</div>";
    }
    $conn->close();
    ?>

</body>
</html>
