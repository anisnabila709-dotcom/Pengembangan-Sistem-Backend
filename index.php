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
        style="margin-right:15px; text-decoration:none; color:black;">' .
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
  <title>Daftar Produk</title>

<style>
    body { font-family: Arial; padding:20px; background:#FFF6FA; }
    h1 { color:#D15F9B; }

    .nav a {
        margin-right: 15px;
        text-decoration: none;
        color:#D15F9B;
    }

    .add-btn {
        background:#FF8EC7;
        color:white;
        padding:7px 12px;
        border-radius:5px;
        text-decoration:none;
    }

    table {
        width:95%;
        margin:0 auto;
        border-collapse: collapse;
        background:white;
        margin-top:15px;
        border:1px solid #F5B5D7;
    }

    th {
        background:#FFD9EC;
        padding:10px;
        text-align:left;
    }

    td {
        padding:10px;
        border-bottom:1px solid #F5B5D7;
    }

    .product-img {
        width:100px; height:100px;
        object-fit:cover;
        border-radius:8px;
    }

    .edit-btn {
        background:#7BB0FF; color:white;
        padding:4px 8px; border-radius:4px;
        text-decoration:none;
    }

    .del-btn {
        background:#FF6E7F; color:white;
        padding:4px 8px; border-radius:4px;
        text-decoration:none;
    }
</style>

</head>
<body>

<h1>Daftar Produk</h1>

<?php showNav(); ?>

<a href="create.php" class="add-btn">+ Tambah Produk</a>

<table>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Gambar</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php if (empty($products)): ?>
        <tr><td colspan="7" style="text-align:center;">Belum ada produk.</td></tr>
    <?php else: ?>
        <?php foreach ($products as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['nama_produk']) ?></td>
            <td><?= htmlspecialchars($p['kategori']) ?></td>
            <td>Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>

            <td>

                <?php if ($p['gambar_path']): ?>
                    <img src="<?= UPLOAD_URL . $p['gambar_path'] ?>" class="product-img">
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>

            <td>
                <?= ($p['status'] === 'active') ? "Ada" : " Tidak Ada" ?>
            </td>

            <td>
                <a href="edit.php?id=<?= $p['id'] ?>" class="edit-btn">Edit</a>
                <a href="delete.php?id=<?= $p['id'] ?>" class="del-btn"
                   onclick="return confirm('Apakah anda benar ingin menghapusnya?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>
</body>
</html>
