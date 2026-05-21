<?php
// Struktur: admin-page -> admin -> page -> assets -> config
require_once __DIR__ . '/../../../../config/koneksi.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>alert('ID tidak valid!'); window.history.back();</script>";
    exit;
}

$id = (int) $_GET['id'];

$stmt = $conn->prepare("
    SELECT sk.*, p.nama_produk
    FROM sub_kategori sk
    JOIN produk p ON sk.id_produk = p.id_produk
    WHERE sk.sub_kategori_id = ?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$row) {
    die("Data tidak ditemukan.");
}

$gender   = mysqli_query($conn, "SELECT * FROM gender");
$kategori = mysqli_query($conn, "SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Sub Kategori</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Inter', sans-serif; background: #f5f5f4; color: #1c1c1c; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 40px 16px; }
    .wrap { width: 100%; max-width: 440px; }
    .page-meta { font-size: 12px; color: #999; margin-bottom: 6px; }
    .page-meta a { color: #999; text-decoration: none; }
    .page-meta span { margin: 0 5px; }
    .page-title { font-size: 20px; font-weight: 500; color: #1c1c1c; margin-bottom: 24px; }
    .card { background: #fff; border: 1px solid #e8e8e8; border-radius: 10px; padding: 28px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
    .field { margin-bottom: 20px; }
    label { display: block; font-size: 13px; color: #666; margin-bottom: 7px; }
    input[type="text"], select { width: 100%; padding: 10px 12px; font-size: 14px; font-family: inherit; color: #1c1c1c; background: #fff; border: 1px solid #ddd; border-radius: 7px; outline: none; transition: border-color .15s; }
    input[type="text"]:focus, select:focus { border-color: #1c1c1c; }
    .divider { border: none; border-top: 1px solid #efefef; margin: 24px 0 20px; }
    .actions { display: flex; gap: 8px; }
    .btn-save { flex: 1; padding: 10px; font-size: 14px; font-family: inherit; font-weight: 500; color: #fff; background: #1c1c1c; border: none; border-radius: 7px; cursor: pointer; transition: background .15s; }
    .btn-save:hover { background: #333; }
    .btn-cancel { padding: 10px 18px; font-size: 14px; font-family: inherit; color: #888; background: none; border: 1px solid #e0e0e0; border-radius: 7px; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; transition: background .15s; }
    .btn-cancel:hover { background: #f5f5f4; }
  </style>
</head>
<body>

  <div class="wrap">
    <p class="page-meta">
      <a href="dashboard.php">Dashboard</a>
      <span>/</span> Sub Kategori
      <span>/</span> Edit
    </p>
    <h1 class="page-title">Edit sub kategori</h1>

    <div class="card">
      <form action="update.php" method="POST">
        <input type="hidden" name="sub_kategori_id" value="<?= $row['sub_kategori_id']; ?>">

        <div class="field">
          <label for="id_gender">Gender</label>
          <select name="id_gender" id="id_gender" required>
            <?php while ($g = mysqli_fetch_assoc($gender)) : ?>
              <option value="<?= $g['id_gender']; ?>" <?= $g['id_gender'] == $row['id_gender'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($g['gender']); ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="field">
          <label for="nama_produk">Nama Produk</label>
          <input type="text" name="nama_produk" id="nama_produk"
                 value="<?= htmlspecialchars($row['nama_produk']); ?>" required>
        </div>

        <div class="field">
          <label for="id_kategori">Kategori</label>
          <select name="id_kategori" id="id_kategori" required>
            <?php while ($k = mysqli_fetch_assoc($kategori)) : ?>
              <option value="<?= $k['id_kategori']; ?>" <?= $k['id_kategori'] == $row['id_kategori'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($k['kategori']); ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>

        <hr class="divider">

        <div class="actions">
          <button type="submit" name="update" class="btn-save">Update Data</button>
          <a href="dashboard.php" class="btn-cancel">Batal</a>
        </div>

      </form>
    </div>
  </div>

</body>
</html>