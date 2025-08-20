<?php 
    include 'header.php';
?>

<!-- PRODUK TERBARU -->
<div class="container my-5">
    <h2 class="mb-4 border-bottom border-4 border-warning pb-2"><b>Produk Kami</b></h2>

    <!-- Form Pencarian -->
    <form method="GET" action="produk.php" class="mb-4">
        <div class="input-group" style="max-width: 400px;">
            <input type="text" name="keyword" class="form-control" placeholder="Cari produk..." value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
            <button class="btn btn-warning" type="submit">Cari</button>
        </div>
    </form>

    <div class="row g-4">
        <?php 
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
        if (!empty($keyword)) {
            $query = "SELECT * FROM produk WHERE nama LIKE '%$keyword%'";
        } else {
            $query = "SELECT * FROM produk";
        }

        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100 shadow-sm border-0">
                <img src="image/produk/<?= $row['image']; ?>" class="card-img-top" alt="<?= $row['nama']; ?>" style="object-fit: cover; height: 200px;">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title text-primary"><?= $row['nama']; ?></h5>
                        <p class="card-text fw-semibold text-success">Rp<?= number_format($row['harga'], 0, ',', '.'); ?></p>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <a href="detail_produk.php?produk=<?= $row['kode_produk']; ?>" class="btn btn-warning btn-sm w-50 me-1">Detail</a>
                        <?php if(isset($_SESSION['kd_cs'])){ ?>
                            <a href="proses/add.php?produk=<?= $row['kode_produk']; ?>&kd_cs=<?= $kode_cs; ?>&hal=1" class="btn btn-success btn-sm w-50 ms-1">
                                <i class="bi bi-cart-plus"></i> Tambah
                            </a>
                        <?php } else { ?>
                            <a href="keranjang.php" class="btn btn-success btn-sm w-50 ms-1">
                                <i class="bi bi-cart-plus"></i> Tambah
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php 
        }
        ?>
    </div>
</div>

<?php 
    include 'footer.php';
?>
