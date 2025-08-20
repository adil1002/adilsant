<?php 
session_start();
include 'koneksi/koneksi.php';
if (isset($_SESSION['kd_cs'])) {
    $kode_cs = $_SESSION['kd_cs'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOBO PETSHOP</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .topbar {
            background-color: #f8f9fa;
            font-size: 14px;
            padding: 5px 0;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .nav-link {
            color: #333 !important;
        }
    </style>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<!-- TOP BAR -->
<div class="container-fluid topbar text-white py-2" style="background-color: #51c4d3;">
    <div class="row justify-content-center text-center">
        <div class="col-md-4">
            <i class="bi bi-telephone"></i> +6289507871885
        </div>
        <div class="col-md-4">
            <i class="bi bi-envelope"></i> adilsantoso1002.com
        </div>
        <div class="col-md-4 fw-semibold">
            <strong>BOBO PETSHOP</strong>
        </div>
    </div>
</div>


<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand text-primary" href="index.php"><b>BOBO PETSHOP</b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="produk.php" class="nav-link">Produk</a></li>
                <li class="nav-item"><a href="about.php" class="nav-link">Tentang Kami</a></li>
                <li class="nav-item"><a href="manual.php" class="nav-link">Manual Aplikasi</a></li>

                <!-- Keranjang -->
                <li class="nav-item">
                    <?php 
                    if (isset($_SESSION['kd_cs'])) {
                        $cek = mysqli_query($conn, "SELECT kode_produk FROM keranjang WHERE kode_customer = '$kode_cs'");
                        $value = mysqli_num_rows($cek);
                        echo "<a href='keranjang.php' class='nav-link'><i class='bi bi-cart'></i> [$value]</a>";
                    } else {
                        echo "<a href='keranjang.php' class='nav-link'><i class='bi bi-cart'></i> [0]</a>";
                    }
                    ?>
                </li>

                <!-- Akun -->
                <?php if (!isset($_SESSION['user'])): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="akunDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> Akun
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="user_login.php">Login</a></li>
                            <li><a class="dropdown-item" href="register.php">Register</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> <?= $_SESSION['user']; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="proses/logout.php">Log Out</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>
