<?php
require_once 'config.php';

// Pastikan datang dari form
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php?msg=Akses tidak valid");
    exit;
}

// Ambil data dari form
$id        = $_POST['id'];
$nama      = trim($_POST['nama_produk']);
$kategori  = trim($_POST['kategori']);
$harga     = $_POST['harga'];
$stok      = $_POST['stok'];
$status    = $_POST['status'];

$errors = [];

// Validasi
if ($nama === '') $errors[] = "Nama produk wajib diisi.";
if ($kategori === '') $errors[] = "Kategori wajib dipilih.";
if (!is_numeric($harga) || $harga <= 0) $errors[] = "Harga harus angka dan lebih besar dari 0.";
if (!is_numeric($stok) || $stok < 0) $errors[] = "Stok harus angka dan tidak boleh negatif.";
if ($status === '') $errors[] = "Status wajib dipilih.";

// Ambil data lama (untuk ambil gambar lama)
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id LIMIT 1");
$stmt->execute([':id' => $id]);
$old = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$old) {
    header("Location: index.php?msg=Produk tidak ditemukan");
    exit;
}

// Default: tetap pakai gambar lama
$gambar_name = $old['gambar_path'];

// Jika upload gambar baru
if (!empty($_FILES['gambar']['name'])) {

    $allowed_ext = ['jpg', 'jpeg', 'png'];
    $max_size = 2 * 1024 * 1024; // 2MB

    $file_name = $_FILES['gambar']['name'];
    $file_size = $_FILES['gambar']['size'];
    $temp_name = $_FILES['gambar']['tmp_name'];

    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed_ext)) {
        $errors[] = "Gambar harus JPG/PNG.";
    }

    if ($file_size > $max_size) {
        $errors[] = "Ukuran gambar maksimal 2MB.";
    }

    // jika lolos
    if (empty($errors)) {
        $new_name = time() . "_" . $file_name;

        // Upload file
        if (move_uploaded_file($temp_name, UPLOAD_DIR . $new_name)) {

            // Hapus gambar lama jika ada
            if (!empty($old['gambar_path']) && file_exists(UPLOAD_DIR . $old['gambar_path'])) {
                unlink(UPLOAD_DIR . $old['gambar_path']);
            }

            $gambar_name = $new_name;
        } else {
            $errors[] = "Gagal Mengupload Gambar.";
        }
    }
}

// Jika tidak ada error → update DB
if (empty($errors)) {

    $stmt = $pdo->prepare("
        UPDATE products SET 
            nama_produk = :nama,
            kategori = :kategori,
            harga = :harga,
            stok = :stok,
            gambar_path = :gambar,
            status = :status
        WHERE id = :id
    ");

    $stmt->execute([
        ':nama'   => $nama,
        ':kategori' => $kategori,
        ':harga'  => $harga,
        ':stok'   => $stok,
        ':gambar' => $gambar_name,
        ':status' => $status,
        ':id'     => $id
    ]);

    header("Location: index.php?msg=Produk berhasil diperbarui");
    exit;
}

// Jika ada error → balik ke edit.php
$msg = urlencode(implode(" | ", $errors));
header("Location: edit.php?id=$id&msg=$msg");
exit;
