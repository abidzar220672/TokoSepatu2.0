<?php
$dir = dirname(__FILE__);
require_once $dir . '/../../../config/koneksi.php';
$gender   = mysqli_query($conn, "SELECT * FROM gender");
$kategori = mysqli_query($conn, "SELECT * FROM kategori");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Produk — Vans Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
    body{font-family:'Inter',sans-serif;background:#f0f2f5;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:30px 16px}
    .card{background:#fff;border-radius:14px;padding:32px;width:100%;max-width:460px;border:1px solid #e2e8f0}
    .back{display:inline-flex;align-items:center;gap:6px;font-size:12px;color:#64748b;text-decoration:none;margin-bottom:20px}
    .back:hover{color:#1d4ed8}
    h2{font-size:1.1rem;font-weight:600;color:#1e293b;margin-bottom:22px}
    label{display:block;font-size:13px;font-weight:500;color:#374151;margin-bottom:6px}
    select,input[type=text]{width:100%;padding:10px 13px;border:1px solid #e2e8f0;border-radius:8px;font-size:14px;font-family:inherit;color:#1e293b;background:#fff;outline:none;transition:border .15s}
    select:focus,input[type=text]:focus{border-color:#1d4ed8}
    .mb{margin-bottom:16px}
    .btn-row{display:flex;gap:10px;margin-top:24px}
    .btn-save{flex:1;padding:11px;background:#1d4ed8;color:#fff;border:none;border-radius:8px;font-size:14px;font-weight:600;cursor:pointer;font-family:inherit;transition:background .15s}
    .btn-save:hover{background:#1e40af}
    .btn-cancel{padding:11px 20px;background:#f1f5f9;color:#64748b;border:1px solid #e2e8f0;border-radius:8px;font-size:14px;text-decoration:none;font-weight:500}
    .btn-cancel:hover{background:#e2e8f0}
  </style>
</head>
<body>
  <div class="card">
    <a href="../index.php" class="back"><i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard</a>
    <h2><i class="fa-solid fa-plus" style="color:#1d4ed8;margin-right:8px"></i>Tambah Sub Kategori</h2>

    <form action="proses.php" method="POST">
      <div class="mb">
        <label>Gender</label>
        <select name="id_gender" required>
          <option value="">-- Pilih gender --</option>
          <?php while($g=mysqli_fetch_assoc($gender)): ?>
          <option value="<?=$g['id_gender']?>"><?=htmlspecialchars($g['gender'])?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="mb">
        <label>Nama Produk</label>
        <input type="text" name="nama_produk" placeholder="Contoh: Vans Old Skool" required>
      </div>
      <div class="mb">
        <label>Kategori</label>
        <select name="id_kategori" required>
          <option value="">-- Pilih kategori --</option>
          <?php while($k=mysqli_fetch_assoc($kategori)): ?>
          <option value="<?=$k['id_kategori']?>"><?=htmlspecialchars($k['kategori'])?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="btn-row">
        <button type="submit" name="submit" class="btn-save"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
        <a href="../index.php" class="btn-cancel">Batal</a>
      </div>
    </form>
  </div>
</body>
</html>