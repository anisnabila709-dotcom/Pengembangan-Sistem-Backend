<?php
require_once 'config.php';

// pastikan ada ID
if (!isset($_GET['id'])) {
    header("Location: index.php?msg=ID tidak ditemukan");
    exit;
}

$id = $_GET['id'];

// Ambil data produk untuk cek gambar
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id LIMIT 1");
$stmt->execute([':id' => $id]);
$produk = $stmt->fetch(PDO::FETCH_ASSOC);

// jika tidak ditemukan
if (!$produk) {
    header("Location: index.php?msg=Produk tidak ditemukan");
    exit;
}

// Hapus gambar jika ada & file-nya memang ada
if (!empty($produk['gambar_path'])) {
    $file = UPLOAD_DIR . $produk['gambar_path'];
    if (file_exists($file)) {
        unlink($file);
    }
}

// Hapus data dari database
$stmt = $pdo->prepare("DELETE FROM products WHERE id = :id");
$stmt->execute([':id' => $id]);

header("Location: index.php?msg=Produk berhasil dihapus");
exit;
