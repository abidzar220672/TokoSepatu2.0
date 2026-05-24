<?php
$dir = dirname(__FILE__);
require_once $dir . '/../../config/koneksi.php';

// Base URL otomatis
$protocol    = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$domain      = $_SERVER['HTTP_HOST'];
$doc_root    = rtrim(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']), '/');
$current_dir = rtrim(str_replace('\\', '/', dirname(__FILE__)), '/');
$rel_path    = str_replace($doc_root, '', $current_dir);
$root_path   = rtrim(dirname(dirname(dirname($rel_path))), '/');
$base_url    = $protocol . '://' . $domain . ($root_path ?: '') . '/';

// Query data
$sql = "
  SELECT sk.sub_kategori_id, g.gender, p.nama_produk, k.kategori
  FROM sub_kategori sk
  JOIN gender   g ON sk.id_gender   = g.id_gender
  JOIN produk   p ON sk.id_produk   = p.id_produk
  JOIN kategori k ON sk.id_kategori = k.id_kategori
  ORDER BY sk.sub_kategori_id DESC
";
$result = mysqli_query($conn, $sql);
$total  = $result ? mysqli_num_rows($result) : 0;

$r_men   = mysqli_query($conn,"SELECT COUNT(*) c FROM sub_kategori sk JOIN gender g ON sk.id_gender=g.id_gender WHERE LOWER(g.gender) LIKE '%men%' AND LOWER(g.gender) NOT LIKE '%women%'");
$r_women = mysqli_query($conn,"SELECT COUNT(*) c FROM sub_kategori sk JOIN gender g ON sk.id_gender=g.id_gender WHERE LOWER(g.gender) LIKE '%women%'");
$r_kids  = mysqli_query($conn,"SELECT COUNT(*) c FROM sub_kategori sk JOIN gender g ON sk.id_gender=g.id_gender WHERE LOWER(g.gender) LIKE '%kid%'");
$cnt_men   = $r_men   ? (int)mysqli_fetch_assoc($r_men)['c']   : 0;
$cnt_women = $r_women ? (int)mysqli_fetch_assoc($r_women)['c'] : 0;
$cnt_kids  = $r_kids  ? (int)mysqli_fetch_assoc($r_kids)['c']  : 0;

$msgs  = ['added'=>'✓ Data berhasil ditambahkan','updated'=>'✓ Data berhasil diperbarui','deleted'=>'✓ Data berhasil dihapus'];
$flash = isset($_GET['msg']) ? ($msgs[$_GET['msg']] ?? '') : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin — Vans</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Inter', sans-serif;
      background: #f5f5f5;
      color: #111;
      min-height: 100vh;
    }

    /* ── TOPBAR ── */
    .topbar {
      background: #000;
      padding: 0 28px;
      height: 56px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .topbar-brand {
      color: #fff;
      font-size: 1.1rem;
      font-weight: 700;
      letter-spacing: 2px;
    }
    .topbar-brand span {
      color: #999;
      font-size: 12px;
      font-weight: 400;
      letter-spacing: 0;
      margin-left: 10px;
    }
    .topbar-link {
      color: #ccc;
      font-size: 13px;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 6px;
      transition: color .15s;
    }
    .topbar-link:hover { color: #fff; }

    /* ── LAYOUT ── */
    .wrap { max-width: 1000px; margin: 0 auto; padding: 32px 20px; }

    /* ── FLASH ── */
    .flash {
      background: #f0fdf4;
      border: 1px solid #bbf7d0;
      color: #166534;
      padding: 11px 16px;
      border-radius: 8px;
      font-size: 13.5px;
      margin-bottom: 24px;
    }

    /* ── STAT CARDS ── */
    .stats {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 14px;
      margin-bottom: 28px;
    }
    .stat {
      background: #fff;
      border: 1px solid #e5e5e5;
      border-radius: 10px;
      padding: 18px 20px;
    }
    .stat-label {
      font-size: 11px;
      color: #888;
      text-transform: uppercase;
      letter-spacing: .5px;
      margin-bottom: 8px;
    }
    .stat-value {
      font-size: 2rem;
      font-weight: 700;
      color: #111;
      line-height: 1;
    }
    .stat-sub {
      font-size: 11px;
      color: #aaa;
      margin-top: 4px;
    }

    /* ── TABLE SECTION ── */
    .section-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 14px;
    }
    .section-title {
      font-size: 14px;
      font-weight: 600;
      color: #111;
    }
    .section-sub {
      font-size: 12px;
      color: #999;
      margin-top: 2px;
    }

    .btn-add {
      background: #000;
      color: #fff;
      padding: 9px 18px;
      border-radius: 7px;
      font-size: 13px;
      font-weight: 500;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: background .15s;
    }
    .btn-add:hover { background: #333; }

    /* ── TABLE ── */
    .table-wrap {
      background: #fff;
      border: 1px solid #e5e5e5;
      border-radius: 10px;
      overflow: hidden;
    }
    table { width: 100%; border-collapse: collapse; }
    thead th {
      background: #fafafa;
      font-size: 11px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: .5px;
      color: #888;
      padding: 12px 16px;
      border-bottom: 1px solid #e5e5e5;
      text-align: left;
    }
    tbody td {
      padding: 13px 16px;
      font-size: 13.5px;
      border-bottom: 1px solid #f0f0f0;
      vertical-align: middle;
    }
    tbody tr:last-child td { border-bottom: none; }
    tbody tr:hover td { background: #fafafa; }

    /* badges */
    .badge {
      display: inline-block;
      padding: 3px 10px;
      border-radius: 20px;
      font-size: 11.5px;
      font-weight: 500;
    }
    .b-men    { background: #eff6ff; color: #1d4ed8; }
    .b-women  { background: #fdf4ff; color: #9333ea; }
    .b-kids   { background: #f0fdf4; color: #16a34a; }
    .b-other  { background: #f5f5f5; color: #555; }

    .kat {
      background: #f5f5f5;
      color: #555;
      font-size: 12px;
      padding: 3px 9px;
      border-radius: 5px;
    }

    /* action buttons */
    .btn-edit, .btn-del {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      padding: 5px 12px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 500;
      text-decoration: none;
      transition: opacity .15s;
    }
    .btn-edit { background: #fffbeb; color: #92400e; border: 1px solid #fde68a; }
    .btn-edit:hover { opacity: .8; }
    .btn-del  { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; margin-left: 5px; }
    .btn-del:hover  { opacity: .8; }

    /* empty */
    .empty { text-align: center; padding: 50px 20px; color: #bbb; }
    .empty i { font-size: 2.2rem; display: block; margin-bottom: 12px; }
    .empty p { font-size: 13px; }

    /* no */
    .no { color: #bbb; font-size: 13px; }

    @media (max-width: 700px) {
      .stats { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 480px) {
      .stats { grid-template-columns: 1fr 1fr; }
      .topbar { padding: 0 16px; }
      .wrap { padding: 20px 14px; }
    }
  </style>
</head>
<body>

<!-- TOPBAR -->
<div class="topbar">
  <div class="topbar-brand">
    VANS <span>Admin Dashboard</span>
  </div>
  <a href="<?= $base_url ?>" class="topbar-link">
    <i class="fa-solid fa-arrow-left"></i> Kembali ke Toko
  </a>
</div>

<!-- CONTENT -->
<div class="wrap">

  <?php if ($flash): ?>
  <div class="flash"><?= $flash ?></div>
  <?php endif; ?>

  <!-- STAT CARDS -->
  <div class="stats">
    <div class="stat">
      <div class="stat-label">Total</div>
      <div class="stat-value"><?= $total ?></div>
      <div class="stat-sub">semua produk</div>
    </div>
    <div class="stat">
      <div class="stat-label">Men</div>
      <div class="stat-value"><?= $cnt_men ?></div>
      <div class="stat-sub">produk pria</div>
    </div>
    <div class="stat">
      <div class="stat-label">Women</div>
      <div class="stat-value"><?= $cnt_women ?></div>
      <div class="stat-sub">produk wanita</div>
    </div>
    <div class="stat">
      <div class="stat-label">Kids</div>
      <div class="stat-value"><?= $cnt_kids ?></div>
      <div class="stat-sub">produk anak</div>
    </div>
  </div>

  <!-- TABLE -->
  <div class="section-header">
    <div>
      <div class="section-title">Data Sub Kategori</div>
      <div class="section-sub"><?= $total ?> data</div>
    </div>
    <a href="admin-page/form.php" class="btn-add">
      <i class="fa-solid fa-plus"></i> Tambah
    </a>
  </div>

  <div class="table-wrap">
    <?php if ($total === 0): ?>
      <div class="empty">
        <i class="fa-solid fa-box-open"></i>
        <p>Belum ada data. <a href="admin-page/form.php" style="color:#000">Tambah sekarang</a>.</p>
      </div>
    <?php else: ?>
      <table>
        <thead>
          <tr>
            <th style="width:44px">#</th>
            <th>Gender</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th style="width:140px">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; mysqli_data_seek($result, 0); while ($row = mysqli_fetch_assoc($result)): ?>
          <tr>
            <td class="no"><?= $no++ ?></td>
            <td>
              <?php
                $g  = strtolower($row['gender']);
                $bc = str_contains($g,'women') ? 'b-women' : (str_contains($g,'men') ? 'b-men' : (str_contains($g,'kid') ? 'b-kids' : 'b-other'));
              ?>
              <span class="badge <?= $bc ?>"><?= htmlspecialchars($row['gender']) ?></span>
            </td>
            <td><?= htmlspecialchars($row['nama_produk']) ?></td>
            <td><span class="kat"><?= htmlspecialchars($row['kategori']) ?></span></td>
            <td>
              <a href="admin-page/edit.php?id=<?= $row['sub_kategori_id'] ?>" class="btn-edit">
                <i class="fa-solid fa-pen"></i> Edit
              </a>
              <a href="admin-page/delete.php?id=<?= $row['sub_kategori_id'] ?>" class="btn-del"
                 onclick="return confirm('Yakin hapus data ini?')">
                <i class="fa-solid fa-trash"></i>
              </a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>

</div>

</body>
</html>