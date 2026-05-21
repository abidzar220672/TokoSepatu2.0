<?php
require_once '../../../../assets/config/koneksi.php';

if (isset($_POST['update'])) {
  $id = $_POST['sub_kategori_id'];
  $id_gender = $_POST['id_gender'];
  $nama_produk = trim($_POST['nama_produk']);
  $id_kategori = $_POST['id_kategori'];

  // Cek apakah produk sudah ada
  $stmt_cek = $conn->prepare("SELECT id_produk FROM produk WHERE nama_produk = ?");
  $stmt_cek->bind_param("s", $nama_produk);
  $stmt_cek->execute();
  $result = $stmt_cek->get_result();

  if ($result->num_rows > 0) {
    // Produk sudah ada, ambil ID-nya
    $row = $result->fetch_assoc();
    $id_produk = $row['id_produk'];
  } else {
    // Produk belum ada, insert baru
    $stmt_insert = $conn->prepare("INSERT INTO produk (nama_produk) VALUES (?)");
    $stmt_insert->bind_param("s", $nama_produk);
    $stmt_insert->execute();
    $id_produk = $stmt_insert->insert_id;
    $stmt_insert->close();
  }

  $stmt_cek->close();

  // Update sub_kategori
  $stmt_update = $conn->prepare("UPDATE sub_kategori SET id_gender=?, id_produk=?, id_kategori=? WHERE sub_kategori_id=?");
  $stmt_update->bind_param("iiii", $id_gender, $id_produk, $id_kategori, $id);

  if ($stmt_update->execute()) {
    echo "<script>alert('Data berhasil diperbarui!'); window.location.href='dashboard.php';</script>";
  } else {
    echo "<script>alert('Gagal update: " . $stmt_update->error . "'); window.history.back();</script>";
  }

  $stmt_update->close();
}

if (!isset($_POST['update'])) {
  header("Location: ../index.php");
  exit;
}
?>