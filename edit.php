<?php

require_once 
'config.php';

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
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Produk</title>
</head>
<body style="font-family: Arial; padding:20px;">

  <header>
    <h1>Edit Produk</h1>
  </header>

  <a href="index.php">← Kembali</a>
  <br><br>

  <main>
    <section>
      <form action="update.php" method="post" enctype="multipart/form-data">

        <div class="row">
          <label>Nama Produk:</label>
          <input type="text" name="nama_produk" 
                 value="<?= htmlspecialchars($produk['nama_produk']) ?>" 
                 required>
        </div>

        <div class="row">
          <label>Kategori:</label>
          <select name="kategori" required>
            <option value="Kalung" <?= $produk['kategori']=='Kalung'?'selected':'' ?>>Kalung</option>
            <option value="Cincin" <?= $produk['kategori']=='Cincin'?'selected':'' ?>>Cincin</option>
            <option value="Anting" <?= $produk['kategori']=='Anting'?'selected':'' ?>>Anting</option>
            <option value="Gelang" <?= $produk['kategori']=='Gelang'?'selected':'' ?>>Gelang</option>
            <option value="Aksesoris Rambut" <?= $produk['kategori']=='Aksesoris Rambut'?'selected':'' ?>>Aksesoris Rambut</option>
          </select>
        </div>

        <div class="row">
          <label>Harga:</label>
          <input type="number" name="harga" value="<?= $produk['harga'] ?>" required>
        </div>

        <div class="row">
          <label>Stok:</label>
          <input type="number" name="stok" value="<?= $produk['stok'] ?>" required>
        </div>

        <div class="row">
          <label>Gambar Saat Ini:</label>
          <?php if ($produk['gambar_path']) : ?>
              <img src="<?= UPLOAD_URL . $produk['gambar_path'] ?>" width="70"><br>
          <?php else : ?>
              <i>Belum ada gambar</i><br>
          <?php endif; ?>
        </div>

        <div class="row">
          <label>Upload Gambar Baru (opsional):</label>
          <input type="file" name="gambar" accept=".jpg,.jpeg,.png">
        </div>

        <div class="row">
          <label>Status:</label>
          <select name="status" required>
            <option value="active" <?= $produk['status']=='active'?'selected':'' ?>>Ada</option>
            <option value="inactive" <?= $produk['status']=='inactive'?'selected':'' ?>>Tidak Ada</option>
          </select>
        </div>

        <div class="row">
          <input type="hidden" name="id" value="<?= $produk['id'] ?>">
          <button type="submit">Update Produk</button>
        </div>

      </form>
    </section>
  </main>

</body>
</html>
