<?php
$dir = dirname(__FILE__);
require_once $dir . '/../../../config/koneksi.php';

if (!isset($_POST['submit'])) { header("Location: ../index.php"); exit; }

$id_gender   = (int)$_POST['id_gender'];
$nama_produk = trim($_POST['nama_produk']);
$id_kategori = (int)$_POST['id_kategori'];

$cek = $conn->prepare("SELECT id_produk FROM produk WHERE nama_produk = ?");
$cek->bind_param("s", $nama_produk);
$cek->execute();
$res = $cek->get_result();
if ($res->num_rows > 0) {
    $id_produk = $res->fetch_assoc()['id_produk'];
} else {
    $ins = $conn->prepare("INSERT INTO produk (nama_produk) VALUES (?)");
    $ins->bind_param("s", $nama_produk);
    $ins->execute();
    $id_produk = $ins->insert_id;
    $ins->close();
}
$cek->close();

$stmt = $conn->prepare("INSERT INTO sub_kategori (id_gender, id_produk, id_kategori) VALUES (?,?,?)");
$stmt->bind_param("iii", $id_gender, $id_produk, $id_kategori);
if ($stmt->execute()) {
    header("Location: ../index.php?msg=added");
} else {
    echo "<script>alert('Gagal: ".addslashes($stmt->error)."'); window.history.back();</script>";
}
$stmt->close();