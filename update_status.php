<?php
include './php/function.php';
$id_pesanan = $_GET['id'];

$result =  $koneksi->query("SELECT * FROM pesanan WHERE id = '$id_pesanan'");
$row = $result->fetch_assoc();



$query = ("UPDATE pesanan SET status_pesanan = 'diterima' WHERE id = '$id_pesanan'");

mysqli_query($koneksi, $query);

echo "<script>alert('barang diterima')</script>";
echo "<script>location = 'pesanan.php'</script>";
