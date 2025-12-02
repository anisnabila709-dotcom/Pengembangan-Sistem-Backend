<?php
require_once 'config.php';

// Ambil ID produk
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php?msg=ID tidak ditemukan");
    exit;
}

// Ambil data produk
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id LIMIT 1");
$stmt->execute([':id' => $id]);
$produk = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produk) {
    header("Location: index.php?msg=Produk tidak ditemukan");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
</head>

<body style="font-family: Arial; padding:20px;">

    <h1>Edit Produk</h1>

    <a href="index.php" 
   style="
       display:inline-block;
       padding:6px 12px;
       background:#e5e5e5;
       color:#333;
       text-decoration:none;
       border-radius:4px;
       font-size:14px;
   ">
   ← Kembali
</a>

    <br><br>

    <form action="update.php" method="POST" enctype="multipart/form-data" style="width:350px;">

        <label>Nama Produk:</label><br>
        <input type="text" name="nama_produk" style="width:100%;" 
               value="<?= htmlspecialchars($produk['nama_produk']) ?>" required><br><br>

        <label>Kategori:</label><br>
        <select name="kategori" style="width:100%;" required>
            <option value="Kalung" <?= $produk['kategori']=='Kalung'?'selected':'' ?>>Kalung</option>
            <option value="Cincin" <?= $produk['kategori']=='Cincin'?'selected':'' ?>>Cincin</option>
            <option value="Anting" <?= $produk['kategori']=='Anting'?'selected':'' ?>>Anting</option>
            <option value="Gelang" <?= $produk['kategori']=='Gelang'?'selected':'' ?>>Gelang</option>
            <option value="Pita" <?= $produk['kategori']=='Pita'?'selected':'' ?>>Pita</option>
            <option value="Aksesoris Rambut" <?= $produk['kategori']=='Aksesoris Rambut'?'selected':'' ?>>Aksesoris Rambut</option>
        </select>
        <br><br>

        <label>Harga (Rp):</label><br>
        <input type="number" name="harga" style="width:100%;" 
               value="<?= $produk['harga'] ?>" required><br><br>

        <label>Stok:</label><br>
        <input type="number" name="stok" style="width:100%;" 
               value="<?= $produk['stok'] ?>" required><br><br>

        <label>Gambar Produk Baru (Opsional):</label><br>
        <input type="file" name="gambar" accept=".jpg,.jpeg,.png"><br>

        <!-- preview gambar -->
        <img src="uploads/<?= htmlspecialchars($produk['gambar_path']) ?>" 
             style="width:120px; margin-top:10px; border-radius:4px;">
        <br><br>

        <label>Status:</label><br>
        <select name="status" style="width:100%;" required>
            <option value="active" <?= $produk['status']=='active'?'selected':'' ?>>Ada</option>
            <option value="inactive" <?= $produk['status']=='inactive'?'selected':'' ?>>Tidak Ada</option>
        </select>
        <br><br>

        <input type="hidden" name="id" value="<?= $produk['id'] ?>">

        <button type="submit"
        style="
            padding:8px 15px;
            background:#4CAF50;
            color:white;
            border:none;
            border-radius:4px;
        ">
            Update Produk
        </button>

    </form>

</body>
</html>
