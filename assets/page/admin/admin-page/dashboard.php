<?php
// 1. Tampilkan semua error untuk mempermudah tracking
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. Aktifkan laporan error mysqli
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// 3. Path Koneksi - Menggunakan __DIR__ agar path absolut dan aman di hosting
// Struktur: admin-page -> admin (..) -> page (..) -> assets (..) -> config
$path_koneksi = __DIR__ . "/../../../config/koneksi.php";

if (file_exists($path_koneksi)) {
    include $path_koneksi;
} else {
    die("Error: File koneksi.php tidak ditemukan di: " . $path_koneksi);
}

// 4. Query JOIN - Pastikan nama tabel dan kolom sesuai database
try {
    $query = "
      SELECT 
        sk.sub_kategori_id,
        g.gender,
        p.nama_produk,
        k.kategori
      FROM sub_kategori sk
      JOIN gender g ON sk.id_gender = g.id_gender
      JOIN produk p ON sk.id_produk = p.id_produk
      JOIN kategori k ON sk.id_kategori = k.id_kategori
    ";

    // Gunakan $conn (pastikan di koneksi.php namanya sama)
    $result = mysqli_query($conn, $query);
} catch (Exception $e) {
    die("Kesalahan Query: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Sub Kategori</title>
  <style>
    body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f4f7f6; padding: 30px; margin: 0; }
    .container { max-width: 1000px; margin: auto; }
    table { border-collapse: collapse; width: 100%; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
    th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #eee; }
    th { background-color: #007bff; color: white; text-transform: uppercase; font-size: 14px; }
    tr:hover { background-color: #f1f1f1; }
    .button { padding: 8px 16px; background: #28a745; color: white; text-decoration: none; border-radius: 4px; display: inline-block; font-size: 14px; }
    .btn-edit { background: #ffc107; color: #333; }
    .btn-delete { background: #dc3545; }
    .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    h2 { color: #333; margin: 0; }
  </style>
</head>
<body>

<div class="container">
  <div class="top-bar">
    <h2>Data Sub Kategori</h2>
    <a href="form.php" class="button">+ Tambah Data</a>
  </div>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Gender</th>
        <th>Produk</th>
        <th>Kategori</th>
        <th style="width: 150px;">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (mysqli_num_rows($result) > 0) : ?>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
          <tr>
            <td><?= htmlspecialchars($row['sub_kategori_id']); ?></td>
            <td><?= htmlspecialchars($row['gender']); ?></td>
            <td><?= htmlspecialchars($row['nama_produk']); ?></td>
            <td><?= htmlspecialchars($row['kategori']); ?></td>
            <td>
              <a href="edit.php?id=<?= $row['sub_kategori_id']; ?>" class="button btn-edit">Edit</a>
              <a href="delete.php?id=<?= $row['sub_kategori_id']; ?>" class="button btn-delete" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else : ?>
        <tr>
          <td colspan="5" style="text-align: center;">Data kosong atau belum ada data yang terhubung.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

</body>
</html>
