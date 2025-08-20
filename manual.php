<?php 
include 'header.php';
?>

<div class="container my-5">
    <h2 class="border-bottom border-4 border-success pb-2 mb-4"><b>Manual Aplikasi</b></h2>

    <div class="accordion" id="manualAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Bagaimana Cara Berbelanja di Toko Bobo Petshop?
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#manualAccordion">
                <div class="accordion-body">
                    <ol>
                        <li>Pastikan Anda sudah Daftar/Register terlebih dahulu.</li>
                        <li>Pilih produk yang ingin dibeli melalui halaman produk.</li>
                        <li>Masukkan ke keranjang, lalu lakukan proses Checkout.</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Bisa ditambah item lainnya di sini -->
        <!--
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Pertanyaan Lainnya
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#manualAccordion">
                <div class="accordion-body">
                    Konten pertanyaan lainnya di sini...
                </div>
            </div>
        </div>
        -->
    </div>
</div>

<?php 
include 'footer.php';
?>
