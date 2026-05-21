<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include __DIR__ . '/../../../config/koneksi.php';

$gender   = mysqli_query($conn, "SELECT * FROM gender ORDER BY gender ASC");
$kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY kategori ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Sub Kategori</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap">
  <style>
    body { font-family: 'Inter', sans-serif; background: #f5f5f4; display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px; }
    .card { background: #fff; border: 1px solid #e8e8e8; border-radius: 10px; padding: 28px; width: 100%; max-width: 440px; }
    .field { margin-bottom: 20px; }
    label { display: block; font-size: 13px; color: #666; margin-bottom: 7px; }
    input, select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 7px; }
    .btn-save { width: 100%; padding: 10px; background: #1c1c1c; color: #fff; border: none; border-radius: 7px; cursor: pointer; margin-top: 10px; }
    .btn-cancel { display: block; text-align: center; margin-top: 10px; color: #888; text-decoration: none; font-size: 14px; }
  </style>
</head>
<body>
  <div class="card">
    <h2 style="margin-bottom: 20px;">Tambah Sub Kategori</h2>
    <form action="proses.php" method="POST">
      <div class="field">
        <label>Gender</label>
        <select name="id_gender" required>
          <option value="">Pilih gender</option>
          <?php while ($g = mysqli_fetch_assoc($gender)) : ?>
            <option value="<?= $g['id_gender'] ?>"><?= htmlspecialchars($g['gender']) ?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="field">
        <label>Nama Produk Baru</label>
        <input type="text" name="nama_produk" placeholder="Contoh: Vans Old Skool" required>
      </div>
      <div class="field">
        <label>Kategori</label>
        <select name="id_kategori" required>
          <option value="">Pilih kategori</option>
          <?php while ($k = mysqli_fetch_assoc($kategori)) : ?>
            <option value="<?= $k['id_kategori'] ?>"><?= htmlspecialchars($k['kategori']) ?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <button type="submit" name="submit" class="btn-save">Simpan Data</button>
      <a href="dashboard.php" class="btn-cancel">Batal</a>
    </form>
  </div>
</body>
</html>
