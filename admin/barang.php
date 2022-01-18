<?php
session_start();
include '../php/function.php';
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}
if (isset($_POST["addBarang"])) {
    if (addBarang($_POST) > 0) {
        echo "<script>
				alert('Barang baru berhasil ditambahkan!');
			  </script>";
    } else {
        echo mysqli_error($koneksi);
    }
}

$jumlahDataPerHalaman = 3;
$jumlahData = count(query("SELECT * FROM item"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$barang = query("SELECT * FROM item LIMIT $awalData, $jumlahDataPerHalaman");

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
                        <a href="pesanan.php" class="nav-link text-white">
                            <i class="bi bi-cart-fill"></i>
                            Pesanan
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link active text-white">
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
            <h3 class="mt-4 mb-3">Barang</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bi bi-plus-lg"></i> Add Barang
            </button>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Gambar</th>

                        <th scope="col">Kode</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Kategori</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    $i = 1;

                    foreach ($barang as $row) : ?>
                        <tr>
                            <th><?= $i; ?></th>
                            <td><img src="../assets/images/<?= $row['gambar']; ?>" alt="" height="50" width="50"> </td>
                            <td><?= $row['kode']; ?></td>
                            <td><?= $row['nama']; ?></td>
                            <td><?= rupiah($row['harga']); ?></td>
                            <td><?= $row['kategori']; ?></td>
                        </tr>
                    <?php $i++;
                    endforeach;
                    ?>
                </tbody>
            </table>
            <div class="text-center">
                <a class="btn btn-outline-dark" href="?halaman=1">awal</a>



                <?php if ($halamanAktif > 1) : ?>
                    <a class="btn btn-outline-dark" href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
                <?php endif; ?>


                <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                    <?php if ($i == $halamanAktif) : ?>
                        <a class="btn btn-outline-dark active" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                    <?php else : ?>
                        <a class="btn btn-outline-dark" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($halamanAktif < $jumlahHalaman) : ?>
                    <a class="btn btn-outline-dark" href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
                <?php endif; ?>

                <a class="btn btn-outline-dark" href="?halaman=<?= $jumlahHalaman; ?>">akhir</a>

            </div>


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="Tambah Barang" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <label for="kode" class="form-label">Kode Barang</label>
                                <input class="form-control" id="kode" name="kode" type="text" aria-label="default input example">
                                <label for="kode" class="form-label">Nama Barang</label>
                                <input class="form-control" id="nama" name="nama" type="text" aria-label="default input example">
                                <label for="kode" class="form-label">Harga Barang</label>
                                <input class="form-control" id="nama" name="harga" type="number" aria-label="default input example">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-select" id="kategori" name="kategori" aria-label="Default select example">
                                    <option value="Laptop" selected>Laptop</option>
                                    <option value="Handphone">Handphone</option>
                                    <option value="PC">PC</option>
                                </select>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Gambar</label>
                                    <input class="form-control" name="gambar" type="file" id="gambar">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="addBarang" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->



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