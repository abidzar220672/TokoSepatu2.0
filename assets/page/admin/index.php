<?php
$dir = dirname(__FILE__);
require_once $dir . '/../../config/koneksi.php';

$sql = "
  SELECT sk.sub_kategori_id, g.gender, p.nama_produk, k.kategori
  FROM sub_kategori sk
  JOIN gender   g ON sk.id_gender   = g.id_gender
  JOIN produk   p ON sk.id_produk   = p.id_produk
  JOIN kategori k ON sk.id_kategori = k.id_kategori
  ORDER BY sk.sub_kategori_id DESC
";
$result = mysqli_query($conn, $sql);

$total   = $result ? mysqli_num_rows($result) : 0;
$r_men   = mysqli_query($conn,"SELECT COUNT(*) c FROM sub_kategori sk JOIN gender g ON sk.id_gender=g.id_gender WHERE LOWER(g.gender) LIKE '%men%' AND LOWER(g.gender) NOT LIKE '%women%'");
$r_women = mysqli_query($conn,"SELECT COUNT(*) c FROM sub_kategori sk JOIN gender g ON sk.id_gender=g.id_gender WHERE LOWER(g.gender) LIKE '%women%'");
$r_kids  = mysqli_query($conn,"SELECT COUNT(*) c FROM sub_kategori sk JOIN gender g ON sk.id_gender=g.id_gender WHERE LOWER(g.gender) LIKE '%kid%'");
$cnt_men   = $r_men   ? (int)mysqli_fetch_assoc($r_men)['c']   : 0;
$cnt_women = $r_women ? (int)mysqli_fetch_assoc($r_women)['c'] : 0;
$cnt_kids  = $r_kids  ? (int)mysqli_fetch_assoc($r_kids)['c']  : 0;

$flash = '';
if (isset($_GET['msg'])) {
  $msgs = ['added'=>'Data berhasil ditambahkan!','updated'=>'Data berhasil diperbarui!','deleted'=>'Data berhasil dihapus!'];
  $flash = $msgs[$_GET['msg']] ?? '';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard — Vans Toko Sepatu</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --bg:       #f0f2f5;
      --sidebar:  #0f172a;
      --sidebar-hover: #1e293b;
      --sidebar-active: #1d4ed8;
      --accent:   #1d4ed8;
      --accent-h: #1e40af;
      --white:    #ffffff;
      --card-br:  14px;
      --text:     #1e293b;
      --muted:    #64748b;
      --border:   #e2e8f0;
      --danger:   #ef4444;
      --success:  #22c55e;
      --warning:  #f59e0b;
      --info:     #3b82f6;
      --sidebar-w: 240px;
      --topbar-h:  64px;
    }

    body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; }

    /* ── SIDEBAR ── */
    .sidebar {
      position: fixed; top: 0; left: 0; bottom: 0;
      width: var(--sidebar-w);
      background: var(--sidebar);
      display: flex; flex-direction: column;
      z-index: 100; overflow-y: auto;
    }
    .sidebar-brand {
      padding: 22px 24px 18px;
      border-bottom: 1px solid rgba(255,255,255,.07);
    }
    .sidebar-brand h1 {
      color: #fff; font-size: 1.3rem; font-weight: 700; letter-spacing: 2px;
    }
    .sidebar-brand p { color: #94a3b8; font-size: 11px; margin-top: 2px; }

    .sidebar-section { padding: 18px 14px 6px; }
    .sidebar-section-label {
      font-size: 10px; text-transform: uppercase; letter-spacing: 1px;
      color: #475569; font-weight: 600; padding: 0 10px; margin-bottom: 6px;
    }
    .nav-item {
      display: flex; align-items: center; gap: 10px;
      padding: 10px 12px; border-radius: 8px; cursor: pointer;
      text-decoration: none; color: #94a3b8; font-size: 13.5px; font-weight: 500;
      transition: background .15s, color .15s;
    }
    .nav-item i { width: 18px; text-align: center; font-size: 15px; }
    .nav-item:hover { background: var(--sidebar-hover); color: #e2e8f0; }
    .nav-item.active { background: var(--sidebar-active); color: #fff; }
    .sidebar-footer {
      margin-top: auto; padding: 16px 14px;
      border-top: 1px solid rgba(255,255,255,.07);
    }

    /* ── TOPBAR ── */
    .topbar {
      position: fixed; top: 0; left: var(--sidebar-w); right: 0;
      height: var(--topbar-h); background: var(--white);
      border-bottom: 1px solid var(--border);
      display: flex; align-items: center; justify-content: space-between;
      padding: 0 28px; z-index: 99;
    }
    .topbar-left h2 { font-size: 15px; font-weight: 600; color: var(--text); }
    .topbar-left p  { font-size: 12px; color: var(--muted); }
    .topbar-right { display: flex; align-items: center; gap: 12px; }
    .btn-store {
      display: flex; align-items: center; gap: 7px;
      padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 500;
      background: var(--accent); color: #fff; text-decoration: none;
      transition: background .15s;
    }
    .btn-store:hover { background: var(--accent-h); }

    /* ── MAIN ── */
    .main {
      margin-left: var(--sidebar-w);
      padding-top: var(--topbar-h);
      min-height: 100vh;
    }
    .content { padding: 28px; }

    /* ── FLASH ── */
    .flash {
      display: flex; align-items: center; gap: 10px;
      background: #dcfce7; border: 1px solid #86efac; color: #15803d;
      padding: 12px 16px; border-radius: 10px; margin-bottom: 22px;
      font-size: 14px; font-weight: 500;
    }

    /* ── STAT CARDS ── */
    .stat-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 18px; margin-bottom: 26px; }
    .stat-card {
      background: var(--white); border-radius: var(--card-br);
      padding: 20px 22px; border: 1px solid var(--border);
      display: flex; align-items: center; gap: 16px;
      transition: box-shadow .2s;
    }
    .stat-card:hover { box-shadow: 0 4px 20px rgba(0,0,0,.07); }
    .stat-icon {
      width: 50px; height: 50px; border-radius: 12px;
      display: flex; align-items: center; justify-content: center;
      font-size: 1.3rem; flex-shrink: 0;
    }
    .stat-icon.blue   { background: #eff6ff; color: #1d4ed8; }
    .stat-icon.pink   { background: #fdf2f8; color: #db2777; }
    .stat-icon.green  { background: #f0fdf4; color: #16a34a; }
    .stat-icon.orange { background: #fff7ed; color: #ea580c; }
    .stat-label { font-size: 12px; color: var(--muted); margin-bottom: 4px; }
    .stat-value { font-size: 1.7rem; font-weight: 700; color: var(--text); line-height: 1; }

    /* ── TABLE CARD ── */
    .table-card {
      background: var(--white); border-radius: var(--card-br);
      border: 1px solid var(--border); overflow: hidden;
    }
    .table-card-header {
      padding: 18px 22px; display: flex; align-items: center;
      justify-content: space-between; border-bottom: 1px solid var(--border);
    }
    .table-card-header h3 { font-size: 15px; font-weight: 600; }
    .table-card-header p  { font-size: 12px; color: var(--muted); margin-top: 2px; }
    .btn-add {
      display: flex; align-items: center; gap: 6px;
      padding: 9px 18px; border-radius: 8px; font-size: 13px; font-weight: 600;
      background: var(--accent); color: #fff; text-decoration: none;
      transition: background .15s;
    }
    .btn-add:hover { background: var(--accent-h); }

    .data-table { width: 100%; border-collapse: collapse; }
    .data-table thead th {
      background: #f8fafc; font-size: 11px; font-weight: 600;
      text-transform: uppercase; letter-spacing: .6px; color: var(--muted);
      padding: 12px 18px; border-bottom: 1px solid var(--border); text-align: left;
    }
    .data-table tbody td {
      padding: 13px 18px; font-size: 13.5px; border-bottom: 1px solid #f1f5f9;
      vertical-align: middle;
    }
    .data-table tbody tr:last-child td { border-bottom: none; }
    .data-table tbody tr:hover td { background: #f8fafc; }

    .no-col  { color: var(--muted); font-size: 13px; }
    .prod-name { font-weight: 500; }

    /* gender badges */
    .badge {
      display: inline-block; padding: 3px 11px; border-radius: 20px;
      font-size: 11.5px; font-weight: 600;
    }
    .badge-men    { background: #eff6ff; color: #1d4ed8; }
    .badge-women  { background: #fdf2f8; color: #db2777; }
    .badge-kids   { background: #f0fdf4; color: #16a34a; }
    .badge-unisex { background: #faf5ff; color: #7c3aed; }

    .kat-tag {
      background: #f1f5f9; color: #475569;
      padding: 3px 10px; border-radius: 6px; font-size: 12px;
    }

    /* action buttons */
    .btn-edit, .btn-del {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 6px 13px; border-radius: 7px; font-size: 12px;
      font-weight: 500; text-decoration: none; transition: all .15s;
    }
    .btn-edit { background: #fffbeb; color: #b45309; border: 1px solid #fde68a; }
    .btn-edit:hover { background: #fde68a; }
    .btn-del  { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; margin-left: 5px; }
    .btn-del:hover  { background: #fecaca; }

    /* empty state */
    .empty-state { text-align: center; padding: 60px 20px; color: var(--muted); }
    .empty-state i { font-size: 2.8rem; display: block; margin-bottom: 14px; opacity: .4; }
    .empty-state p { font-size: 14px; margin-bottom: 16px; }

    /* responsive */
    @media (max-width: 1024px) { .stat-grid { grid-template-columns: repeat(2,1fr); } }
    @media (max-width: 768px) {
      .sidebar { transform: translateX(-100%); }
      .main, .topbar { left: 0; margin-left: 0; }
      .stat-grid { grid-template-columns: 1fr 1fr; }
    }
  </style>
</head>
<body>

<!-- ══ SIDEBAR ══ -->
<aside class="sidebar">
  <div class="sidebar-brand">
    <h1>VANS</h1>
    <p>Admin Panel</p>
  </div>

  <div class="sidebar-section">
    <div class="sidebar-section-label">Menu</div>
    <a href="index.php" class="nav-item active">
      <i class="fa-solid fa-table-columns"></i> Dashboard
    </a>
    <a href="admin-page/form.php" class="nav-item">
      <i class="fa-solid fa-plus"></i> Tambah Produk
    </a>
  </div>

  <div class="sidebar-section">
    <div class="sidebar-section-label">Navigasi</div>
    <a href="../../index.php" class="nav-item">
      <i class="fa-solid fa-store"></i> Lihat Toko
    </a>
  </div>

  <div class="sidebar-footer">
    <a href="../../index.php" class="nav-item">
      <i class="fa-solid fa-arrow-left"></i> Kembali ke Toko
    </a>
  </div>
</aside>

<!-- ══ TOPBAR ══ -->
<div class="topbar">
  <div class="topbar-left">
    <h2>Dashboard</h2>
    <p>Manajemen data sub kategori produk</p>
  </div>
  <div class="topbar-right">
    <a href="../../index.php" class="btn-store">
      <i class="fa-solid fa-store"></i> Lihat Toko
    </a>
  </div>
</div>

<!-- ══ MAIN ══ -->
<div class="main">
  <div class="content">

    <?php if ($flash): ?>
    <div class="flash">
      <i class="fa-solid fa-circle-check"></i> <?= htmlspecialchars($flash) ?>
    </div>
    <?php endif; ?>

    <!-- STAT CARDS -->
    <div class="stat-grid">
      <div class="stat-card">
        <div class="stat-icon blue"><i class="fa-solid fa-shoe-prints"></i></div>
        <div>
          <div class="stat-label">Total Produk</div>
          <div class="stat-value"><?= $total ?></div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon orange"><i class="fa-solid fa-mars"></i></div>
        <div>
          <div class="stat-label">Men</div>
          <div class="stat-value"><?= $cnt_men ?></div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon pink"><i class="fa-solid fa-venus"></i></div>
        <div>
          <div class="stat-label">Women</div>
          <div class="stat-value"><?= $cnt_women ?></div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon green"><i class="fa-solid fa-child"></i></div>
        <div>
          <div class="stat-label">Kids</div>
          <div class="stat-value"><?= $cnt_kids ?></div>
        </div>
      </div>
    </div>

    <!-- TABLE -->
    <div class="table-card">
      <div class="table-card-header">
        <div>
          <h3>Data Sub Kategori</h3>
          <p><?= $total ?> data ditemukan</p>
        </div>
        <a href="admin-page/form.php" class="btn-add">
          <i class="fa-solid fa-plus"></i> Tambah Data
        </a>
      </div>

      <?php if ($total === 0): ?>
        <div class="empty-state">
          <i class="fa-solid fa-box-open"></i>
          <p>Belum ada data sub kategori.</p>
          <a href="admin-page/form.php" class="btn-add" style="display:inline-flex">
            <i class="fa-solid fa-plus"></i> Tambah Sekarang
          </a>
        </div>
      <?php else: ?>
        <div style="overflow-x:auto">
          <table class="data-table">
            <thead>
              <tr>
                <th style="width:50px">#</th>
                <th>Gender</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th style="width:170px">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; mysqli_data_seek($result,0); while ($row = mysqli_fetch_assoc($result)): ?>
              <tr>
                <td class="no-col"><?= $no++ ?></td>
                <td>
                  <?php
                    $g = strtolower($row['gender']);
                    if      (str_contains($g,'women')) $bc = 'badge-women';
                    elseif  (str_contains($g,'men'))   $bc = 'badge-men';
                    elseif  (str_contains($g,'kid'))   $bc = 'badge-kids';
                    else                               $bc = 'badge-unisex';
                  ?>
                  <span class="badge <?= $bc ?>"><?= htmlspecialchars($row['gender']) ?></span>
                </td>
                <td class="prod-name"><?= htmlspecialchars($row['nama_produk']) ?></td>
                <td><span class="kat-tag"><?= htmlspecialchars($row['kategori']) ?></span></td>
                <td>
                  <a href="admin-page/edit.php?id=<?= $row['sub_kategori_id'] ?>" class="btn-edit">
                    <i class="fa-solid fa-pen-to-square"></i> Edit
                  </a>
                  <a href="admin-page/delete.php?id=<?= $row['sub_kategori_id'] ?>"
                     class="btn-del"
                     onclick="return confirm('Yakin ingin menghapus data ini?')">
                    <i class="fa-solid fa-trash"></i>
                  </a>
                </td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>

  </div><!-- /content -->
</div><!-- /main -->

</body>
</html>