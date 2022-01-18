<?php
include 'php/function.php';

session_start();
if (isset($_SESSION["login"])) {
	header("Location: index.php");
	exit;
}
if (isset($_POST['login'])) {
	$email = $_POST['inputEmail'];
	$password = $_POST['inputPassword'];
	$result = mysqli_query($koneksi, "SELECT * FROM user WHERE email = '$email'");
	$row = mysqli_fetch_assoc($result);
	if ($row['role'] == 'pelanggan') {
		if (mysqli_num_rows($result) === 1) {
			if (password_verify($password, $row["password"])) {
				$_SESSION['login'] = true;
				header("Location: index.php");
				$_SESSION['id'] = $row["id"];
				$_SESSION['admin'] = false;
			} else {
				echo "<script>alert('password salah')</script>";
				echo "<script>location = 'login.php'</script>";
			}

			exit;
		} else {
			echo "user tidak ditemukan";
		}
	} else {
		if (mysqli_num_rows($result) === 1) {
			if (password_verify($password, $row["password"])) {
				$_SESSION['login'] = true;
				$_SESSION['id'] = $row["id"];
				$_SESSION['admin'] = true;
				header("Location: admin");
			} else {
				echo "<script>alert('password salah')</script>";
				echo "<script>location = 'login.php'</script>";
			}


			exit;
		} else {
			echo "<script>alert('user tidak ditemukan')</script>";
			echo "<script>location = 'login.php'</script>";
		}
	}
}
?>
<?php include "component/head.php"; ?>

<?php include "component/navbar.php";
echo '
		<script>
			$("#login").addClass("active");
		</script>';
?>



<div class="container mt-4">
	<div class="row">
		<div class="col"></div>
		<div class="col-4">
			<form action="" method="post">
				<div class="mb-3">
					<label for="exampleInputEmail1" class="form-label">Email address</label>
					<input required type="email" class="form-control" id="exampleInputEmail1" name="inputEmail" aria-describedby="emailHelp">
					<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
				</div>
				<div class="mb-3">
					<label for="exampleInputPassword1" class="form-label">Password</label>
					<input required type="password" class="form-control" name="inputPassword" id="exampleInputPassword1">
				</div>
				<p>Belum Punya akun? <a href="signup.php" class="text-decoration-none">Sign Up</a></p>
				<button type="submit" name="login" class="btn btn-primary">Submit</button>
			</form>
		</div>
		<div class="col"></div>

	</div>

</div>
<?php include "component/footer.php"; ?>