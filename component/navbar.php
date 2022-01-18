<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="index.php"><strong>Toko-Online</strong></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a id="home" class="nav-link" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a id="login" class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a id="pesanan" class="nav-link" href="pesanan.php">Pesanan</a>
                </li>

            </ul>
            <div style="margin-right: 20px;">
                <a href="keranjang.php" class="text-white text-decoration-none"><i class="bi bi-cart-check-fill" style="font-size: 30px;"></i>

                </a>

            </div>
            <?php
            if (isset($_SESSION['id'])) {
                $id = $_SESSION['id'];
                $result3 = $koneksi->query("SELECT * FROM user WHERE id = '$id'");
                $ambilUser = $result3->fetch_assoc();

                echo '
            
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left: 20px;">
                    ' . $ambilUser["nama"] . '
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                    </ul>

                </div>
            ';
            } ?>

        </div>
    </div>
</nav>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>