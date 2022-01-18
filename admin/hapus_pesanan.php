<?php
include '../php/function.php';
$key = $_GET['key'];
mysqli_query($koneksi, "DELETE FROM pesanan WHERE key_barang = '$key'");
mysqli_query($koneksi, "DELETE FROM cart WHERE key_pesanan = '$key'");
echo "<script>alert('pesanan dihapus')</script>";
echo "<script>location = 'pesanan.php'</script>";
