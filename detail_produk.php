<?php 
include 'header.php';
session_start();

$kode = mysqli_real_escape_string($conn, $_GET['produk']);
$result = mysqli_query($conn, "SELECT * FROM produk WHERE kode_produk = '$kode'");
$row = mysqli_fetch_assoc($result);

// ambil kode customer dari session
$kode_cs = $_SESSION['kd_cs'] ?? null;
?>

<div class="container">
    <h2 style="width: 100%; border-bottom: 4px solid #80fff9ff"><b>Detail Produk</b></h2>

    <div class="row">
        <div class="col-md-4 text-center">
            <div class="thumbnail">
                <img src="image/produk/<?= $row['image']; ?>" 
                     class="img-fluid img-thumbnail" 
                     style="max-width: 250px; height: auto;" 
                     alt="<?= $row['nama']; ?>">
            </div>
        </div>

        <div class="col-md-8">
            <form action="proses/add.php" method="POST">
                <input type="hidden" name="kd_cs" value="<?= $kode_cs; ?>">
                <input type="hidden" name="produk" value="<?= $kode; ?>">
                <input type="hidden" name="hal" value="2">

                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td><b>Nama</b></td>
                            <td><?= $row['nama']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Harga</b></td>
                            <td>Rp.<?= number_format($row['harga']); ?></td>
                        </tr>
                        <tr>
                            <td><b>Stok Tersedia</b></td>
                            <td><?= $row['kebutuhan']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Deskripsi</b></td>
                            <td><?= $row['deskripsi']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Jumlah</b></td>
                            <td>
                                <input class="form-control" type="number" min="1" name="jml" value="1" style="width: 155px;">
                            </td>
                        </tr>
                    </tbody>
                </table>

                <?php if(isset($_SESSION['user'])) { ?>
                    <button type="submit" class="btn btn-success">
                        <i class="glyphicon glyphicon-shopping-cart"></i> Tambahkan ke Keranjang
                    </button>
                <?php } else { ?>
                    <a href="login.php" class="btn btn-success">
                        <i class="glyphicon glyphicon-shopping-cart"></i> Login untuk Belanja
                    </a>
                <?php } ?>

                <a href="index.php" class="btn btn-warning">Kembali Belanja</a>
            </form>
        </div>
    </div>
</div>  

<br><br>

<?php 
include 'footer.php';
?>
