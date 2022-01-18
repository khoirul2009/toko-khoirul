<?php
session_start();
include 'php/function.php';
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}



?>
<?php include "component/head.php" ?>


<?php include "component/navbar.php";
echo '
		<script>
			$("#pesanan").addClass("active");
		</script>';
?>



<div class="container mt-4">
    <table class="table table-striped table-hover">
        <h3>Pesanan</h3>
        <hr>
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Pemesan</th>
                <th scope="col">Id Pemesanan</th>
                <th scope="col">ALamat</th>
                <th scope="col">Total Bayar</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>

            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php
            $id_pelanggan = $_SESSION['id'];
            $result = mysqli_query($koneksi, "SELECT * FROM pesanan WHERE id_pelanggan = '$id_pelanggan' AND status_pesanan != 'diterima'");


            ?>
            <?php foreach ($result as $row) :;

            ?>

                <?php
                $id = $_SESSION['id'];

                $key_barang = $row['key_barang'];
                $result2 = $koneksi->query("SELECT * FROM cart WHERE key_pesanan = '$key_barang' ");
                $ambil = $result2->fetch_assoc();
                $result3 = $koneksi->query("SELECT * FROM user WHERE id = '$id'");
                $ambilUser = $result3->fetch_assoc();


                if ($row['status_pesanan'] == 'dikirim') {
                    $status =  '<a href="update_status.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm">Terima</a>';
                } else {
                    $status = "Menunggu Konfirmasi";
                }
                ?>

                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $ambilUser['nama']; ?></td>
                    <td><?= $ambil['key_pesanan']; ?></td>
                    <td><?= $row['alamat']; ?></td>
                    <td><?= rupiah($row['total_bayar']); ?></td>
                    <td><?= $row['status_pesanan']; ?></td>
                    <td><?= $status; ?></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach;
            ?>

        </tbody>
    </table>


</div>

<?php include "component/footer.php"; ?>