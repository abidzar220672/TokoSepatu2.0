<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// PERBAIKAN 1: Menggunakan path relatif agar tidak bingung dengan DOCUMENT_ROOT
// Sesuaikan jumlah ../ jika posisi file config berbeda
include "../../../config/koneksi.php"; 

// Query lengkap dengan JOIN antar tabel
$query = "
  SELECT 
    sub_kategori.sub_kategori_id,
    gender.gender,
    produk.nama_produk,
    kategori.kategori
  FROM sub_kategori
  JOIN gender ON sub_kategori.id_gender = gender.id_gender
  JOIN produk ON sub_kategori.id_produk = produk.id_produk
  JOIN kategori ON sub_kategori.id_kategori = kategori.id_kategori
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Sub Kategori</title>
  <style>
    body { font-family: Arial; background: #f4f4f4; padding: 30px; }
    table { border-collapse: collapse; width: 100%; background: white; }
    th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
    th { background-color: #007bff; color: white; }
    tr:nth-child(even) { background-color: #f9f9f9; }
    a.button { padding: 6px 12px; background: #28a745; color: white; text-decoration: none; border-radius: 4px; margin-right: 5px; }
    a.delete { background: #dc3545; }
    .top-bar { margin-bottom: 20px; }
  </style>
</head>
<body>

  <div class="top-bar">
    <h2>Data Sub Kategori</h2>
    <!-- PERBAIKAN 2: Menghapus folder /TokoSepatu/ ganda pada link -->
    <a href="/assets/page/admin/admin-page/form.php" class="button">+ Tambah Data</a>
  </div>

  <table>
    <tr>
      <th>ID</th>
      <th>Gender</th>
      <th>Produk</th>
      <th>Kategori</th>
      <th>Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
      <tr>
        <td><?= htmlspecialchars($row['sub_kategori_id']); ?></td>
        <td><?= htmlspecialchars($row['gender']); ?></td>
        <td><?= htmlspecialchars($row['nama_produk']); ?></td>
        <td><?= htmlspecialchars($row['kategori']); ?></td>
        <td>
          <!-- PERBAIKAN 3: Memastikan path link konsisten (huruf kecil semua) -->
          <a href="/assets/page/admin/admin-page/edit.php?id=<?= $row['sub_kategori_id']; ?>" class="button">Edit</a>
          <a href="/assets/page/admin/admin-page/delete.php?id=<?= $row['sub_kategori_id']; ?>" class="button delete" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>

</body>
</html>
