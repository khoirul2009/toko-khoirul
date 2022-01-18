<?php
session_start();
include 'php/function.php';



?>
<?php include "component/head.php"; ?>
<?php include "component/navbar.php" ?>


<div class="container mt-4">
    <table class="table table-striped table-hover">
        <h3>Keranjang Barang</h3>
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
    <div>
        <a href="index.php" class="btn btn-primary">Lanjutkan Belanja</a>
        <a href="checkout.php" class="btn btn-success">Check Out</a>
    </div>

</div>
<?php include "component/footer.php"; ?>