<?php

require_once 'config.php';

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nama = trim($_POST['nama_produk']);
    $kategori = trim($_POST['kategori']);
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $status = $_POST['status'];

    $errors = [];

    // Validasi
    if ($nama === '') $errors[] = "Nama produk wajib diisi.";
    if ($kategori === '') $errors[] = "Kategori wajib dipilih.";
    if (!is_numeric($harga) || $harga <= 0) $errors[] = "Harga harus berupa angka dan lebih besar dari 0.";
    if (!is_numeric($stok) || $stok < 0) $errors[] = "Stok harus berupa angka dan tidak boleh negatif.";
    if ($status === '') $errors[] = "Status wajib dipilih.";

    // Validasi file upload
    $gambar_name = "";
    
    if (!empty($_FILES['gambar']['name'])) {
        
        $allowed_ext = ['jpg','jpeg','png'];
        $max_size = 2 * 1024 * 1024; // 2MB
        
        $file_name = $_FILES['gambar']['name'];
        $file_size = $_FILES['gambar']['size'];
        $tmp_name = $_FILES['gambar']['tmp_name'];

        $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed_ext)) {
            $errors[] = "Format gambar harus JPG/PNG.";
        }

        if ($file_size > $max_size) {
            $errors[] = "Ukuran gambar maksimal 2MB.";
        }

        if (empty($errors)) {
            // rename file
            $new_name = time() . "_" . $file_name;

            if (!move_uploaded_file($tmp_name, UPLOAD_DIR . $new_name)) {
                $errors[] = "Gagal mengupload gambar.";
            } else {
                $gambar_name = $new_name;
            }
        }
    }

    // Jika tidak ada error → insert
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO products (nama_produk, kategori, harga, stok, gambar_path, status)
                VALUES (:nama, :kategori, :harga, :stok, :gambar, :status)
            ");

            $stmt->execute([
                ':nama' => $nama,
                ':kategori' => $kategori,
                ':harga' => $harga,
                ':stok' => $stok,
                ':gambar' => $gambar_name,
                ':status' => $status
            ]);

            header("Location: index.php?msg=Produk berhasil ditambahkan");
            exit;

        } catch (PDOException $e) {
            $errors[] = "Gagal menyimpan ke database: " . $e->getMessage();
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
</head>

<body style="font-family: Arial; padding:20px;">

    <h1>Tambah Produk Baru</h1>

    <!-- FIX: TIDAK ADA url() -->
    <a href="index.php">← Kembali ke Daftar Produk</a>
    <br><br>

    <!-- tampilkan error -->
    <?php if (!empty($errors)): ?>
        <div style="padding:10px; background:#ffe5e5; border:1px solid red; width:400px;">
            <b>Terjadi kesalahan:</b>
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <br>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data" style="width:350px;">

        <label>Nama Produk:</label><br>
        <input type="text" name="nama_produk" style="width:100%;" required><br><br>

        <label>Kategori:</label><br>
        <select name="kategori" style="width:100%;" required>
            <option value="">-- Pilih Kategori --</option>
            <option value="Kalung">Kalung</option>
            <option value="Cincin">Cincin</option>
            <option value="Anting">Anting</option>
            <option value="Gelang">Gelang</option>
            <option value="Pita">Pita</option>
            <option value="Aksesoris Rambut">Aksesoris Rambut</option>
        </select>
        <br><br>

        <label>Harga (Rp):</label><br>
        <input type="number" name="harga" style="width:100%;" required><br><br>

        <label>Stok:</label><br>
        <input type="number" name="stok" style="width:100%;" required><br><br>

        <label>Gambar Produk (JPG/PNG max 2MB):</label><br>
        <input type="file" name="gambar" accept=".jpg,.jpeg,.png"><br><br>

        <label>Status:</label><br>
        <select name="status" style="width:100%;" required>
            <option value="">-- Pilih Status --</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
        <br><br>

        <button type="submit"
        style="
            padding:8px 15px;
            background:#4CAF50;
            color:white;
            border:none;
            border-radius:4px;
        ">
            Simpan Produk
        </button>

    </form>

</body>
</html>
