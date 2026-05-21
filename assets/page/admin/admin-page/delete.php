<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include $_SERVER['DOCUMENT_ROOT'] . "/TokoSepatu/assets/config/koneksi.php";

// Validasi ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  echo "<script>alert('ID tidak valid!'); window.history.back();</script>";
  exit;
}

$id = (int) $_GET['id'];

// Eksekusi DELETE
$stmt = $conn->prepare("DELETE FROM sub_kategori WHERE sub_kategori_id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
  echo "<script>alert('Data berhasil dihapus!'); window.location.href='dashboard.php';</script>";
} else {
  echo "<script>alert('Gagal hapus: " . $stmt->error . "'); window.history.back();</script>";
}

$stmt->close();
header("Location: ../index.php");
?>