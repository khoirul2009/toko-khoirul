<?php
include 'php/function.php';
session_start();

$sql = "SELECT * FROM item WHERE kategori = 'PC'";
$query = mysqli_query($koneksi, $sql);

$sql2 = "SELECT * FROM cart";
$query2 = mysqli_query($koneksi, $sql2);


if (!$query) {
    die('SQL Error: ' . mysqli_error($koneksi));
}
if (isset($_POST["submit"])) {

    if (insertCart($_POST) > 0) {
        echo "<script>
				alert('barang ditambahkan ke keranjang');
			  </script>";
    } else {
        echo mysqli_error($conn);
    }
}

?>

<?php include "component/head.php"; ?>
<?php include "component/navbar.php" ?>



<div class="container mt-4">

    <div class="option col mb-3">
        <select class="form-select" aria-label="Default select example" onchange="location = this.value">

            <option value="index.php">Laptop</option>
            <option value="handphone.php" selected>Handphone</option>
            <option value="pc.php" selected>Handphone</option>
        </select>
    </div>
    <div class="row">

        <?php include "component/sidebar.php";
        echo '
		<script>
			$("#pc").addClass("active");
		</script>';
        ?>

        <?php $i = 1; ?>

        <?php foreach ($query as $row) : ?>

            <div class="col-6 col-lg-2">
                <div class="card shadow mb-4">
                    <img src="assets/images/<?= $row['gambar']; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text"><?= $row['nama']; ?></p>
                        <p class="card-text"><?= rupiah($row['harga']); ?></p>
                        <div class="d-grid gap-2">
                            <a href="beli.php?id=<?php echo $row['id']; ?>" type="button" class="btn btn-primary" id="pesan"><i class="bi bi-cart-plus-fill"></i></a>
                        </div>
                    </div>

                </div>

            </div>
            <?php $i++; ?>
        <?php endforeach; ?>


    </div>
    <?php include "component/footer.php"; ?>
</div>



<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).on("click", "#pesan", function() {
        let id = $(this).data('id');
        let kode = $(this).data('kode');
        let nama = $(this).data('nama');
        let harga = $(this).data('harga');

        $("#kode").val(kode);
        $("#nama_produk").val(nama);
        $("#harga_produk").val(harga);

    })
</script>
<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>