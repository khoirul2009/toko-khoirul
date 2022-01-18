<?php
include '../php/function.php';
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM user WHERE id = '$id'");
mysqli_query($koneksi, "DELETE FROM pesanan WHERE id_pelanggan = '$id'");

echo "<script>alert('user dihapus')</script>";
echo "<script>location = 'index.php'</script>";
