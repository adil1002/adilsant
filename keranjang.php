<?php 
include 'header.php';

// ==== PROSES UPDATE QTY ====
if(isset($_POST['update_qty'])){
    $id_keranjang = intval($_POST['id_keranjang']);
    $qty = intval($_POST['qty']);

    if($qty > 0){
        $sql = "UPDATE keranjang SET qty = '$qty' WHERE id_keranjang = '$id_keranjang'";
        $edit = mysqli_query($conn, $sql);

        if($edit){
            header("Location: keranjang.php"); // reload supaya data terbaru muncul
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// ==== PROSES DELETE ====
if(isset($_GET['del']) && isset($_GET['id'])){
    $id_keranjang = intval($_GET['id']);
    $del = mysqli_query($conn, "DELETE FROM keranjang WHERE id_keranjang = '$id_keranjang'");
    if($del){
        header("Location: keranjang.php");
        exit;
    }
}
?>

<div class="container" style="padding-bottom: 300px;">
    <h2 style="width: 100%; border-bottom: 4px solid #0e31f8ff"><b>Keranjang</b></h2>
    <table class="table table-striped">
        <?php 
        if(isset($_SESSION['user'])){
            $kode_cs = $_SESSION['kd_cs'];

            // CEK JUMLAH KERANJANG
            $cek = mysqli_query($conn, "SELECT * FROM keranjang WHERE kode_customer = '$kode_cs'");
            $jml = mysqli_num_rows($cek);

            if($jml > 0){ ?> 
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>SubTotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $result = mysqli_query($conn, "
                    SELECT k.id_keranjang AS keranjang, 
                           k.kode_produk AS kd, 
                           k.nama_produk AS nama, 
                           k.qty AS jml, 
                           p.image AS gambar, 
                           p.harga AS hrg 
                    FROM keranjang k 
                    JOIN produk p ON k.kode_produk = p.kode_produk 
                    WHERE kode_customer = '$kode_cs'
                ");

                $no = 1;
                $hasil = 0;
                while($row = mysqli_fetch_assoc($result)){ 
                    $sub = $row['hrg'] * $row['jml'];
                    $hasil += $sub;
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><img src="image/produk/<?= $row['gambar']; ?>" width="100"></td>
                        <td><?= $row['nama']; ?></td>
                        <td>Rp.<?= number_format($row['hrg']); ?></td>
                        <td>
                            <form action="keranjang.php" method="POST" class="d-flex">
                                <input type="hidden" name="id_keranjang" value="<?= $row['keranjang']; ?>">
                                <input type="number" name="qty" class="form-control text-center" style="width:80px;" 
                                       value="<?= $row['jml']; ?>" min="1">
                                <button type="submit" name="update_qty" class="btn btn-warning btn-sm ml-2">Update</button>
                            </form>
                        </td>
                        <td>Rp.<?= number_format($sub); ?></td>
                        <td>
                            <a href="keranjang.php?del=1&id=<?= $row['keranjang']; ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Yakin ingin dihapus ?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
                    <tr>
                        <td colspan="7" style="text-align: right; font-weight: bold;">Grand Total = Rp.<?= number_format($hasil); ?></td>
                    </tr>
                    <tr>
                        <td colspan="7" style="text-align: right; font-weight: bold;">
                            <a href="index.php" class="btn btn-success">Lanjutkan Belanja</a>
                            <a href="checkout.php?kode_cs=<?= $kode_cs; ?>" class="btn btn-primary">Checkout</a>
                        </td>
                    </tr>
                </tbody>
            <?php 
            } else {
                echo "
                <tr>
                    <td colspan='7' class='text-center bg-warning'>
                        <h5><b>KERANJANG BELANJA ANDA KOSONG</b></h5>
                    </td>
                </tr>";
            }
        } else {
            echo "
            <tr>
                <td colspan='7' class='text-center bg-danger'>
                    <h5><b>SILAHKAN LOGIN TERLEBIH DAHULU SEBELUM BERBELANJA</b></h5>
                </td>
            </tr>";
        }
        ?>
    </table>
</div>

<?php include 'footer.php'; ?>
