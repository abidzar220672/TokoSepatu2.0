<?php
include '/TokoSepatu/assets/config/koneksi.php';

if (isset($_POST['submit'])) {
  $id_gender = $_POST['id_gender'];
  $nama_produk = $_POST['nama_produk'];
  $id_kategori = $_POST['id_kategori'];

  // Simpan produk baru
  $stmt_produk = $conn->prepare("INSERT INTO produk (nama_produk) VALUES (?)");
  $stmt_produk->bind_param("s", $nama_produk);
  $stmt_produk->execute();
  $id_produk = $stmt_produk->insert_id;
  $stmt_produk->close();

  // Simpan ke sub_kategori
  $stmt_sub = $conn->prepare("INSERT INTO sub_kategori (id_gender, id_produk, id_kategori) VALUES (?, ?, ?)");
  $stmt_sub->bind_param("sss", $id_gender, $id_produk, $id_kategori);

  if ($stmt_sub->execute()) {
    echo "<script>alert('Data berhasil disimpan!'); window.location.href='dashboard.php';</script>";
  } else {
    echo "<script>alert('Gagal menyimpan data: " . $stmt_sub->error . "'); window.history.back();</script>";
  }

  $stmt_sub->close();
}
header("Location: ../index.php");
?>