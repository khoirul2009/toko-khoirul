<?php
include 'php/function.php';
session_start();

$sql = "SELECT * FROM item WHERE kategori = 'Handphone'";
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
            <option value="pc.php">Handphone</option>
        </select>
    </div>
    <div class="row">

        <?php include "component/sidebar.php";
        echo '
		<script>
			$("#handphone").addClass("active");
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
</div>

<?php include "component/footer.php"; ?>