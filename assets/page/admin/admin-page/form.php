<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// koneksi database
require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/config/koneksi.php';

// ambil data gender & kategori
$gender   = mysqli_query($conn, "SELECT * FROM gender");
$kategori = mysqli_query($conn, "SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Sub Kategori</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap">

  <style>
    *,
    *::before,
    *::after{
      box-sizing:border-box;
      margin:0;
      padding:0;
    }

    body{
      font-family:'Inter',sans-serif;
      background:#f5f5f4;
      color:#1c1c1c;
      min-height:100vh;
      display:flex;
      align-items:center;
      justify-content:center;
      padding:40px 16px;
    }

    .wrap{
      width:100%;
      max-width:440px;
    }

    .page-meta{
      font-size:12px;
      color:#999;
      margin-bottom:6px;
    }

    .page-meta a{
      color:#999;
      text-decoration:none;
    }

    .page-meta span{
      margin:0 5px;
    }

    .page-title{
      font-size:20px;
      font-weight:500;
      margin-bottom:24px;
    }

    .card{
      background:#fff;
      border:1px solid #e8e8e8;
      border-radius:10px;
      padding:28px;
    }

    .field{
      margin-bottom:20px;
    }

    label{
      display:block;
      font-size:13px;
      color:#666;
      margin-bottom:7px;
    }

    input[type="text"],
    select{
      width:100%;
      padding:10px 12px;
      border:1px solid #ddd;
      border-radius:7px;
      font-size:14px;
      outline:none;
    }

    input[type="text"]:focus,
    select:focus{
      border-color:#555;
    }

    .divider{
      border:none;
      border-top:1px solid #efefef;
      margin:24px 0 20px;
    }

    .actions{
      display:flex;
      gap:10px;
    }

    .btn-save{
      flex:1;
      padding:10px;
      border:none;
      border-radius:7px;
      background:#1c1c1c;
      color:white;
      cursor:pointer;
      font-size:14px;
    }

    .btn-save:hover{
      background:#333;
    }

    .btn-cancel{
      padding:10px 18px;
      border:1px solid #ddd;
      border-radius:7px;
      text-decoration:none;
      color:#666;
      display:flex;
      align-items:center;
      justify-content:center;
    }

    .btn-cancel:hover{
      background:#f1f1f1;
    }
  </style>
</head>

<body>

<div class="wrap">

  <p class="page-meta">
    <a href="/index.php">Home</a>
    <span>/</span>
    Sub Kategori
    <span>/</span>
    Tambah
  </p>

  <h1 class="page-title">Tambah Sub Kategori</h1>

  <div class="card">

    <form action="proses.php" method="POST">

      <!-- gender -->
      <div class="field">
        <label for="id_gender">Gender</label>

        <select name="id_gender" id="id_gender" required>

          <option value="">Pilih Gender</option>

          <?php while($g = mysqli_fetch_assoc($gender)) : ?>

            <option value="<?= $g['id_gender']; ?>">
              <?= htmlspecialchars($g['gender']); ?>
            </option>

          <?php endwhile; ?>

        </select>
      </div>

      <!-- produk -->
      <div class="field">
        <label for="nama_produk">Nama Produk</label>

        <input
          type="text"
          name="nama_produk"
          id="nama_produk"
          placeholder="Contoh: Nike Air Max"
          required
        >
      </div>

      <!-- kategori -->
      <div class="field">
        <label for="id_kategori">Kategori</label>

        <select name="id_kategori" id="id_kategori" required>

          <option value="">Pilih Kategori</option>

          <?php while($k = mysqli_fetch_assoc($kategori)) : ?>

            <option value="<?= $k['id_kategori']; ?>">
              <?= htmlspecialchars($k['kategori']); ?>
            </option>

          <?php endwhile; ?>

        </select>
      </div>

      <hr class="divider">

      <div class="actions">

        <button type="submit" name="submit" class="btn-save">
          Simpan
        </button>

        <a href="dashboard.php" class="btn-cancel">
          Batal
        </a>

      </div>

    </form>

  </div>

</div>

</body>
</html>