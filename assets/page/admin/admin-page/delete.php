<?php
require_once __DIR__ . '/../../../../config/koneksi.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>alert('ID tidak valid!'); window.history.back();</script>";
    exit;
}

$id = (int) $_GET['id'];

$stmt = $conn->prepare("DELETE FROM sub_kategori WHERE sub_kategori_id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<script>alert('Data berhasil dihapus!'); window.location.href='dashboard.php';</script>";
} else {
    echo "<script>alert('Gagal hapus: " . $stmt->error . "'); window.history.back();</script>";
}

$stmt->close();
exit;
?>