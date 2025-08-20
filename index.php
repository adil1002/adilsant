<?php
include 'header.php';
?>

<!-- IMAGE -->
<div class="container-fluid p-0">
    <img src="image/home/kaslulll.jpg" class="img-fluid" style="width: 100%; height: 400px; object-fit: cover;">
</div>

<!-- DESKRIPSI TENTANG -->
<div class="container mt-5">
    <h5 class="text-center py-3" style="font-family: 'Poppins', sans-serif; line-height: 26px; font-size: 16px; border-top: 2px solid #d5ff87; border-bottom: 2px solid #b9ff87;">
        Bobopetshop adalah salah satu penyedia kebutuhan hewan peliharaan terpercaya di wilayahnya. Didirikan pada tahun 2024, saat ini dikelola oleh Yudhi Prasetyo sebagai pemilik toko tersebut. Produk kami berkualitas, aman, dan terjangkau untuk semua pecinta hewan.
    </h5>
</div>

<!-- PRODUK KAMI -->
<div class="container mt-5" style="max-width: 1200px;">
    <h4 class="border-bottom pb-2 mb-4" style="border-color: #80f7ff;"><b>Produk Kami</b></h4>
    <div class="row">
        <?php 
        $result = mysqli_query($conn, "SELECT * FROM produk");
        if (mysqli_num_rows($result) == 0) {
            echo "<div class='alert alert-warning text-center'>Belum ada produk yang tersedia.</div>";
        }
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm product-card">
                <img src="image/produk/<?= $row['image']; ?>" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column p-2">
                    <h6 class="card-title mb-1"><?= $row['nama']; ?></h6>
                    <p class="card-text text-success fw-bold mb-2" style="font-size: 14px;">Rp <?= number_format($row['harga']); ?></p>
                    <div class="mt-auto">
                        <div class="row g-1">
                            <div class="col-6">
                                <a href="detail_produk.php?produk=<?= $row['kode_produk']; ?>" class="btn btn-warning btn-sm w-100">Detail</a>
                            </div>
                            <div class="col-6">
                                <a href="tambah_keranjang.php?produk=<?= $row['kode_produk']; ?>" class="btn btn-success btn-sm w-100">
                                    <i class="bi bi-cart"></i> Tambah
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<br><br><br>

<?php include 'footer.php'; ?>
