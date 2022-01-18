<?php
session_start();
include 'php/function.php';
$sql2 = "SELECT * FROM cart WHERE jumlah >= 0";
$query2 = mysqli_query($koneksi, $sql2);
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}
if (!isset($_SESSION['keranjang'])) {
    echo "<script>alert('silahkan pesan barang terlebih dahulu');</script>";
    echo "<script>location = 'index.php';</script>";
}

if (isset($_POST["submitPesan"])) {
    if (buatPesanan($_POST) > 0) {
        echo "<script>
				alert('pesanan telah dibuat');
			  </script>";
        echo "<script>
            location = 'pesanan.php';
          </script>";
    } else {
        echo mysqli_error($koneksi);
    }
}




?>
<?php include "component/head.php" ?>

<?php include "component/navbar.php" ?>


<div class="container mt-4">
    <table class="table table-striped table-hover">
        <h3>CheckOut Barang</h3>
        <hr>
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Nama</th>
                <th scope="col">Harga</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Aksi</th>

            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php if (isset($_SESSION['keranjang'])) { ?>
                <?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) : ?>
                    <?php $ambil = $koneksi->query("SELECT * FROM item WHERE id='$id_produk'");
                    $row = $ambil->fetch_assoc();

                    ?>

                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $jumlah; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= rupiah($row['harga']); ?></td>
                        <td><?= rupiah($jumlah * $row['harga']); ?></td>
                        <td><a href="hapusproduk.php?id=<?php echo $id_produk; ?>"><span class="badge bg-danger">Delete</span></a></td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach;
                ?>
            <?php } ?>
        </tbody>
    </table>
    <form action="" method="post">
        <label for="alamat" class="form-label">Alamat Pengirimanan</label>
        <input type="text" class="form-control" id="alamat" name="alamat" aria-describedby="emailHelp">
        <button class="btn btn-primary mt-4" name="submitPesan" type="submit">Buat Pesanan</button>
    </form>




</div>
<?php include "component/footer.php"; ?>