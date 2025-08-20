<?php 
include 'header.php';
$kd = mysqli_real_escape_string($conn, $_GET['kode_cs']);
$cs = mysqli_query($conn, "SELECT * FROM customer WHERE kode_customer = '$kd'");
$rows = mysqli_fetch_assoc($cs);
$result = mysqli_query($conn, "SELECT * FROM keranjang WHERE kode_customer = '$kd'");
?>

<div class="container" style="padding-bottom: 200px">
    <h2 style="width: 100%; border-bottom: 4px solid #d7ff80ff"><b>Checkout</b></h2>
    
    <h4>Daftar Pesanan</h4>
    <table class="table table-stripped">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Sub Total</th>
        </tr>
        <?php 
        $no = 1;
        $hasil = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $subtotal = $row['harga'] * $row['qty'];
            $hasil += $subtotal;
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama_produk']; ?></td>
                <td>Rp.<?= number_format($row['harga']); ?></td>
                <td><?= $row['qty']; ?></td>
                <td>Rp.<?= number_format($subtotal); ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="5" style="text-align: right; font-weight: bold;">Grand Total = Rp.<?= number_format($hasil); ?></td>
        </tr>
    </table>

    <h5>Isi Form di Bawah Ini</h5>
    <form action="proses/order.php" method="POST">
        <input type="hidden" name="kode_cs" value="<?= $kd; ?>">

        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" name="nama" value="<?= $rows['nama']; ?>" readonly>
        </div>

        <div class="form-group">
            <label for="provinsi">Provinsi</label>
            <input type="text" class="form-control" name="provinsi" placeholder="Masukkan Provinsi" required>
        </div>

        <div class="form-group">
            <label for="kota">Kota</label>
            <input type="text" class="form-control" name="kota" placeholder="Masukkan Kota" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat" required>
        </div>

        <div class="form-group">
            <label for="kode_pos">Kode Pos</label>
            <input type="text" class="form-control" name="kode_pos" placeholder="Masukkan Kode Pos" required>
        </div>
        
        <div class="form-group">
            <label for="nama_bank">Metode Pembayaran</label>
            <select name="nama_bank" id="nama_bank" class="form-control" required onchange="ubahRekening()">
                <option value="">Pilih Metode</option>
                <option value="Mandiri">Bank Mandiri</option>
                <option value="Nagari">Bank Nagari</option>
                <option value="Dana">Dana</option>
            </select>
        </div>

        <div class="form-group" id="rek_group">
            <label for="no_rek">No. Rekening Tujuan</label>
            <input type="text" class="form-control" id="no_rek" name="no_rek" value="" readonly>
        </div>

        <div class="form-group">
            <label for="jumlah">Jumlah Transfer</label>
            <input type="number" class="form-control" name="jumlah" placeholder="Masukkan jumlah transfer" required>
        </div>

        <div class="form-group">
            <label for="atas_nama">Atas Nama</label>
            <input type="text" class="form-control" name="atas_nama" placeholder="Nama pengirim" required>
        </div>

        <button type="submit" class="btn btn-success">Kirim Pembayaran</button>
        <a href="keranjang.php" class="btn btn-danger">Cancel</a>
    </form>
</div>

<script>
function ubahRekening(){
    var bank = document.getElementById("nama_bank").value;
    var noRekField = document.getElementById("no_rek");
    var rekGroup = document.getElementById("rek_group");

    if(bank === "Mandiri"){
        noRekField.value = "123456789 (Adil - Mandiri)";
        rekGroup.style.display = "block";
    }else if(bank === "Nagari"){
        noRekField.value = "987654321 (Adil - Nagari)";
        rekGroup.style.display = "block";
    }else if(bank === "Dana"){
        noRekField.value = "089507871885 (Adil - Dana)";
        rekGroup.style.display = "block";
    }else{
        noRekField.value = "";
        rekGroup.style.display = "block";
    }
}
</script>

<?php 
include 'footer.php';
?> 
