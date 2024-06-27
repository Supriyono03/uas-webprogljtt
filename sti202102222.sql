CREATE DATABASE perpustakaan;

USE perpustakaan;

CREATE TABLE data_buku (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_buku VARCHAR(50) NOT NULL,
    isbn VARCHAR(20) NOT NULL,
    judul_buku VARCHAR(100) NOT NULL,
    pengarang VARCHAR(100) NOT NULL,
    sekilas_isi TEXT,
    tanggal_masuk DATE NOT NULL,
    stok INT NOT NULL,
    foto VARCHAR(100)
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);
INSERT INTO users (username, password) VALUES ('admin', MD5('admin'));
