<?php
require_once '../../../config/koneksi.php';

if (isset($_POST['update'])) {
    // FIX: Cast semua ID ke integer agar type binding "iiii" benar
    $id          = (int) $_POST['sub_kategori_id'];
    $id_gender   = (int) $_POST['id_gender'];
    $nama_produk = trim($_POST['nama_produk']);
    $id_kategori = (int) $_POST['id_kategori'];

    // Cek apakah produk sudah ada
    $stmt_cek = $conn->prepare("SELECT id_produk FROM produk WHERE nama_produk = ?");
    $stmt_cek->bind_param("s", $nama_produk);
    $stmt_cek->execute();
    $result = $stmt_cek->get_result();

    if ($result->num_rows > 0) {
        $row_produk = $result->fetch_assoc();
        $id_produk  = (int) $row_produk['id_produk'];
    } else {
        $stmt_insert = $conn->prepare("INSERT INTO produk (nama_produk) VALUES (?)");
        $stmt_insert->bind_param("s", $nama_produk);
        $stmt_insert->execute();
        $id_produk = (int) $stmt_insert->insert_id;
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
    // FIX: Pakai exit setelah echo/script, bukan header()
    exit;
}

// Jika akses langsung tanpa POST
header("Location: dashboard.php");
exit;
?>