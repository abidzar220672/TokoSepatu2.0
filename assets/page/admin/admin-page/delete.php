<?php
$dir = dirname(__FILE__);
require_once $dir . '/../../../config/koneksi.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ../index.php"); exit;
}
$id   = (int)$_GET['id'];
$stmt = $conn->prepare("DELETE FROM sub_kategori WHERE sub_kategori_id = ?");
$stmt->bind_param("i",$id);
if ($stmt->execute()) {
    header("Location: ../index.php?msg=deleted");
} else {
    echo "<script>alert('Gagal: ".addslashes($stmt->error)."'); window.history.back();</script>";
}
$stmt->close();