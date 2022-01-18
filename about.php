<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <title>Laptop</title>
</head>


<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#"><strong>Toko-Online</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pesanan.php">Pesanan</a>
                    </li>

                </ul>
                <div style="margin-right: 20px;">
                    <a href="keranjang.php" class="text-white text-decoration-none"><i class="bi bi-cart-check-fill" style="font-size: 30px;"></i>
                    </a>
                </div>
                <?php
                if (isset($_SESSION["login"])) {
                    echo '<a href="logout.php" class="btn btn-outline-danger">Logout</a>';
                }
                ?>

            </div>
        </div>
    </nav>


    <div class="container mt-4">
        <h3 class="text-center">About Us</h3>
        <p class="text-center mb-4 mt-3">Toko-Online menjual berbagai macam gadget seperti Laptop, Handphone, PC dan lain - lain yang terpercaya dengan harga yang murah dan kualitas yang terjamin. toko kami memberi garansi sesuai brand produk.</p>
        <div class="row mb-3">
            <div class="col-1">
                <img src="assets/images/wa.png" alt="" width="50" height="50">
            </div>
            <div class="col">
                <h5 class="card-title">Whatsapp</h5>
                <p class="card-text">+62 843 345 234</p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-1">
                <img src="assets/images/fb.png" alt="" width="60" height="50">
            </div>
            <div class="col">
                <h5 class="card-title">Facebook</h5>
                <p class="card-text">Khoirul Afwan</p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-1">
                <img src="assets/images/ig.png" alt="" width="50" height="50">
            </div>
            <div class="col">
                <h5 class="card-title">Instagram</h5>
                <p class="card-text">khoirul_afwan6</p>
            </div>
        </div>
        <p class="fst-italic">Alamat : Jalan Pati-Juana Km 7 Desa Tunjungrejo Rt 02 Rw 01 Kecamatan Margoyoso </p>

    </div>


    <?php include "component/footer.php"; ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>