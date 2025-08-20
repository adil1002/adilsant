<?php
session_start();
include 'koneksi.php'; // pastikan koneksi DB

// Ambil data produk & jumlah dari URL / Form
if (!isset($_GET['produk'])) {
    echo "<script>alert('Produk tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}

$kode_produk = $_GET['produk'];
$jml = isset($_GET['jml']) ? (int)$_GET['jml'] : 1;

// Ambil data produk dari database
$cek_produk = mysqli_query($conn, "SELECT * FROM produk WHERE kode_produk='$kode_produk'");
if (mysqli_num_rows($cek_produk) == 0) {
    echo "<script>alert('Produk tidak tersedia!'); window.location='index.php';</script>";
    exit;
}
$produk = mysqli_fetch_assoc($cek_produk);

// Buat keranjang di session kalau belum ada
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

// Kalau produk sudah ada di keranjang → update jumlah
if (isset($_SESSION['keranjang'][$kode_produk])) {
    $_SESSION['keranjang'][$kode_produk]['jumlah'] += $jml;
} else {
    // Kalau produk belum ada → masukkan baru
    $_SESSION['keranjang'][$kode_produk] = [
        'nama' => $produk['nama'],
        'harga' => $produk['harga'],
        'image' => $produk['image'],
        'jumlah' => $jml
    ];
}

// Redirect ke halaman keranjang
header("Location: keranjang.php");
exit;
?>
