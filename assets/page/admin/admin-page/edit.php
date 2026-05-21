<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once dirname(__DIR__, 4) . '/config/koneksi.php';

echo "EDIT TERBUKA";

if (!isset($_GET['id'])) {
    die("ID tidak ada");
}

$id = $_GET['id'];

$data = mysqli_query($conn, "SELECT * FROM sub_kategori WHERE sub_kategori_id='$id'");

if (!$data) {
    die(mysqli_error($conn));
}

$row = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Sub Kategori</title>
</head>
<body>
  <h2>Edit Sub Kategori</h2>
  <form action="update.php" method="POST">
    <input type="hidden" name="sub_kategori_id" value="<?= $row['sub_kategori_id']; ?>">

    <label>Gender</label>
    <select name="id_gender" required>
      <?php while ($g = mysqli_fetch_assoc($gender)) : ?>
        <option value="<?= $g['id_gender']; ?>" <?= $g['id_gender'] == $row['id_gender'] ? 'selected' : '' ?>>
          <?= $g['gender']; ?>
        </option>
      <?php endwhile; ?>
    </select>

    <label>Nama Produk</label>
  <input type="text" name="nama_produk" placeholder="Masukkan nama produk" required>

    <label>Kategori</label>
    <select name="id_kategori" required>
      <?php while ($k = mysqli_fetch_assoc($kategori)) : ?>
        <option value="<?= $k['id_kategori']; ?>" <?= $k['id_kategori'] == $row['id_kategori'] ? 'selected' : '' ?>>
          <?= $k['kategori']; ?>
        </option>
      <?php endwhile; ?>
    </select>

    <button type="submit" name="update">Update</button>
  </form>
</body>
</html>