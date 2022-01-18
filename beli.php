<?php
session_start();
if (isset($_SESSION["login"])) {
    $id_produk = $_GET['id'];


    if (isset($_SESSION['keranjang'][$id_produk])) {

        # code...
        $_SESSION['keranjang'][$id_produk] += 1;
    } else {
        $_SESSION['keranjang'][$id_produk] = 1;
    }
    echo "<script>
alert('produk telah masuk keranjang');
</script>";
    echo "<script>
location = 'keranjang.php';
</script>";
} else {
    header("Location: login.php");
}
