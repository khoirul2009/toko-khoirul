<?php
include '../php/function.php';
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}
if (isset($_SESSION['admin']) != true) {
    echo '<script>alert("Maaf anda tidak bisa mengakses halaman ini")</script>';
    echo "<script>location = '../index.php'</script>";
}
if (isset($_POST["ubah"])) {
    if (ubahUser($_POST) > 0) {
        echo "<script>
				alert('User berhasil diEdit!');
			  </script>";
    } else {
        echo mysqli_error($koneksi);
    }
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
                        <a href="#" class="nav-link active" aria-current="page">
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
            <h3 class="mt-4">User</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Email</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Password</th>
                        <th scope="col">No Telephone</th>
                        <th scope="col">Role</th>
                        <th>Aksi</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    $i = 1;
                    $result = mysqli_query($koneksi, "SELECT * FROM user");
                    foreach ($result as $row) : ?>
                        <tr>
                            <th><?= $i; ?></th>
                            <td><?= $row['email']; ?></td>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['password']; ?></td>
                            <td><?= $row['no_telp']; ?></td>
                            <td><?= $row['role']; ?></td>
                            <td>
                                <a type="button" id="tombolEdit" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?= $row['id']; ?>" data-email="<?= $row['email']; ?>" data-nama="<?= $row['nama'];  ?>" data-password="<?= $row['password'];  ?>" data-notelp="<?= $row['no_telp']; ?>" data-email="<?= $row['role']; ?>">
                                    Edit
                                </a>
                                <a href="hapus_user.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php $i++;
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <input type="hidden" name="id" id="id">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="input_email" name="email">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="input_nama" name="nama">
                            <label for="notelp" class="form-label">No Telephone</label>
                            <input type="number" class="form-control" id="input_notelp" name="notelp">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" id="input_role" name="role" aria-label="Default select example" required>
                                <option selected>Role</option>
                                <option value="admin">Admin</option>
                                <option value="pelanggan">Pelanggan</option>

                            </select>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="ubah" class="btn btn-primary">Save changes</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).on("click", "#tombolEdit", function() {
            let id = $(this).data('id');
            let email = $(this).data('email');
            let nama = $(this).data('nama');
            let notelp = $(this).data('notelp');
            let password = $(this).data('password');



            $(".modal-body #id").val(id);
            $(".modal-body #password").val(password);
            $(".modal-body #input_email").val(email);
            $(".modal-body #input_nama").val(nama);
            $(".modal-body #input_notelp").val(notelp);

        })
    </script>
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