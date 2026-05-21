<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include __DIR__ . '/../../../config/koneksi.php';

// Ambil ID dari URL
$id = isset($_GET['id']) ? $_GET['id'] : die('Error: ID tidak ditemukan');

// Ambil data sub_kategori yang mau diedit (JOIN dengan produk untuk ambil nama produknya)
$query_data = "SELECT sk.*, p.nama_produk FROM sub_kategori sk 
               JOIN produk p ON sk.id_produk = p.id_produk 
               WHERE sk.sub_kategori_id = '$id'";
$data = mysqli_query($conn, $query_data);
$row = mysqli_fetch_assoc($data);

$gender = mysqli_query($conn, "SELECT * FROM gender");
$kategori = mysqli_query($conn, "SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Sub Kategori</title>
  <style>
    body { font-family: sans-serif; background: #f5f5f4; display: flex; justify-content: center; padding: 50px; }
    .card { background: #fff; padding: 30px; border-radius: 10px; border: 1px solid #ddd; width: 400px; }
    input, select { width: 100%; padding: 10px; margin: 10px 0 20px; border: 1px solid #ccc; border-radius: 5px; }
    button { width: 100%; padding: 10px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
  </style>
</head>
<body>
  <div class="card">
    <h2>Edit Sub Kategori</h2>
    <form action="update.php" method="POST">
      <input type="hidden" name="sub_kategori_id" value="<?= $row['sub_kategori_id']; ?>">
      <input type="hidden" name="id_produk" value="<?= $row['id_produk']; ?>">

      <label>Gender</label>
      <select name="id_gender" required>
        <?php while ($g = mysqli_fetch_assoc($gender)) : ?>
          <option value="<?= $g['id_gender']; ?>" <?= $g['id_gender'] == $row['id_gender'] ? 'selected' : '' ?>>
            <?= $g['gender']; ?>
          </option>
        <?php endwhile; ?>
      </select>

      <label>Nama Produk</label>
      <input type="text" name="nama_produk" value="<?= htmlspecialchars($row['nama_produk']); ?>" required>

      <label>Kategori</label>
      <select name="id_kategori" required>
        <?php while ($k = mysqli_fetch_assoc($kategori)) : ?>
          <option value="<?= $k['id_kategori']; ?>" <?= $k['id_kategori'] == $row['id_kategori'] ? 'selected' : '' ?>>
            <?= $k['kategori']; ?>
          </option>
        <?php endwhile; ?>
      </select>

      <button type="submit" name="update">Update Data</button>
      <a href="dashboard.php" style="display:block; text-align:center; margin-top:15px; color:#666; text-decoration:none;">Batal</a>
    </form>
  </div>
</body>
</html>
