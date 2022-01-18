<?php
session_start();
include '../php/function.php';
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <title>Admin</title>
</head>

<body>

    <div class="row">
        <div class="col" style="display: contents;">
            <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; height: 700px;">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none" style="margin-left: 20px;">
                    <h4>Admin</h4>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link text-white" aria-current="page">
                            <i class="icon bi bi-people-fill"></i>
                            User
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link text-white active">
                            <i class="bi bi-cart-fill"></i>
                            Pesanan
                        </a>
                    </li>
                    <li>
                        <a href="barang.php" class="nav-link text-white">
                            <i class="bi bi-bag-fill"></i>
                            Barang
                        </a>
                    </li>

                </ul>
                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left: 20px;">
                        <?php
                        $id = $_SESSION['id'];
                        $result3 = $koneksi->query("SELECT * FROM user WHERE id = '$id'");
                        $ambilUser = $result3->fetch_assoc();
                        echo $ambilUser["nama"]; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">

                        <li><a class="dropdown-item" href="../logout.php">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col">
            <h3 class="mt-4">Pesanan</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Pemesan</th>
                        <th scope="col">key_pesanan</th>
                        <th scope="col">Alamat Pengiriman</th>
                        <th scope="col">No Telephone</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>


                    </tr>
                </thead>
                <tbody>

                    <?php
                    $i = 1;
                    $result = $koneksi->query("SELECT * FROM pesanan");
                    foreach ($result as $row) :
                        $id = $row['id_pelanggan'];
                        $result4 = $koneksi->query("SELECT * FROM user WHERE id = '$id'");
                        $user = $result4->fetch_assoc();

                        if ($row['status_pesanan'] == 'dipesan') {
                            $status =  '<a href="update_status.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm">Kirim</a>';
                        } else if ($row['status_pesanan'] == 'dikirim') {
                            $status = '-';
                        } else {
                            $status = '<a href="hapus_pesanan.php?key=' . $row['key_barang'] . '" class="btn btn-danger btn-sm">Hapus</a>';
                        }
                    ?>
                        <tr>
                            <th><?= $i; ?></th>
                            <td><?= $user['nama']; ?></td>
                            <td><?= $row['key_barang']; ?></td>
                            <td><?= $row['alamat']; ?></td>
                            <td><?= $user['no_telp']; ?></td>
                            <td><?= $row['status_pesanan']; ?></td>
                            <td><?= $status; ?></td>
                        </tr>
                    <?php $i++;
                    endforeach;
                    ?>
                </tbody>

            </table>
        </div>
    </div>




    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>