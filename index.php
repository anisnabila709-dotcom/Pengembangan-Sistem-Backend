<?php

require_once 'config.php';

// ambil semua produk
$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// fungsi nav
function showNav() {
    global $NAV_PAGES;
    echo '<nav style="margin:15px 0;">';
    foreach ($NAV_PAGES as $page) {
        echo '<a href="' . $page['url'] . '" 
               style="margin-right:15px; text-decoration:none; color:pink;">' .
               $page['title'] .
             '</a>';
    }
    echo '</nav>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Produk</title>
</head>

<body style="font-family: Arial; padding:20px;">

<header>
  <h1>Daftar Produk</h1>
</header>

<?php showNav(); ?>

<main>
  <?php if (isset($_GET['msg'])): ?>
    <div style="padding:10px; background:#e0ffe0; border:1px solid #0a0; width:450px;">
      <?= htmlspecialchars($_GET['msg']) ?>
    </div>
    <br>
  <?php endif; ?>

  <a href="create.php"
     style="padding:6px 12px; background:#4CAF50; color:white; text-decoration:none; border-radius:4px;">
     + Tambah Produk
  </a>
  <br><br>

  <table border="1" cellspacing="0" cellpadding="8" style="border-collapse:collapse; width:95%;">
    <tr style="background:#f2f2f2;">
      <th>ID</th>
      <th>Nama</th>
      <th>Kategori</th>
      <th>Harga</th>
      <th>Stok</th>
      <th>Gambar</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>

    <?php if (empty($products)): ?>
      <tr><td colspan="8" style="text-align:center;">Belum ada produk.</td></tr>
    <?php else: ?>
      <?php foreach ($products as $p): ?>
        <tr>
          <td><?= $p['id'] ?></td>
          <td><?= htmlspecialchars($p['nama_produk']) ?></td>
          <td><?= htmlspecialchars($p['kategori']) ?></td>
          <td>Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
          <td><?= $p['stok'] ?></td>
          <td>
            <?php if ($p['gambar_path']): ?>
              <img src="<?= UPLOAD_URL . $p['gambar_path'] ?>" width="60">
            <?php else: ?> - <?php endif; ?>
          </td>
          <td><?= $p['status'] ?></td>

          <td>
            <a href="edit.php?id=<?= $p['id'] ?>"
               style="padding:4px 8px; background:#2196F3; color:white; text-decoration:none; border-radius:3px;">
               Edit
            </a>
            &nbsp;
            <a href="delete.php?id=<?= $p['id'] ?>"
               onclick="return confirm('Yakin ingin menghapus produk ini?')"
               style="padding:4px 8px; background:#f44336; color:white; text-decoration:none; border-radius:3px;">
               Delete
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </table>

</main>

</body>
</html>


