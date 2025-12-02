create database produk;
use produk;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(150) NOT NULL,
    kategori VARCHAR(50) NOT NULL,
    harga DECIMAL(10,2) NOT NULL,
    stok INT NOT NULL,
    gambar_path VARCHAR(255),
    status ENUM('active', 'inactive') NOT NULL DEFAULT 'active'
);