<?php

// Start session
session_start();

// simple autoload
spl_autoload_register(function ($class_name) {
    $file = __DIR__ . '/class/' . $class_name . '.php';
    if (file_exists($file)) {
        include $file;
    }
});

// database config
const DB_HOST = 'localhost';
const DB_USER = 'root';       // sesuaikan dengan user MySQL Anda
const DB_PASS = '';   // sesuaikan dengan password MySQL Anda
const DB_NAME = 'produk';   // sesuaikan dengan nama database yang sudah dibuat

// PDO
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}

// Define base URL
const BASE_URL = 'http://localhost:8000/tugaspsb/'; // sesuaikan dengan nama folder

//upload directory
const UPLOAD_DIR = __DIR__ . '/uploads/';
const UPLOAD_URL = BASE_URL . '/uploads/';

// Helper URL function
function url($path) {
    return BASE_URL . '/' . ltrim($path, '/');
}

// navigasi config
$NAV_PAGES = [
    ['title' => 'Home', 'url' => 'index.php'],
    ['title' => 'Tambah Produk', 'url' => 'create.php'],
];

// Edit produk
$current_page = basename($_SERVER['PHP_SELF']);

if ($current_page === 'edit.php' && isset($_GET['id'])) {
    $NAV_PAGES[] = [
        'title' => 'Edit Produk (ID ' . $_GET['id'] . ')',
        'url' => 'edit.php?id=' . $_GET['id']
    ];
    }
?>