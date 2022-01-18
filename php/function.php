<?php

$koneksi = mysqli_connect("ec2-34-230-198-12.compute-1.amazonaws.com", "vbynrtowhzeols", "a3af213cba828c37ebaf76b8fa2e77ab121d57cd7f18395a60d4c79bfb80f972", "d2l9smlhltac51");
// $koneksi = mysqli_connect("localhost", "id18259829_khoirul2009", "#Khoirul12345", "id18259829_khoirul");

// Check connection
if (mysqli_connect_errno()) {
	echo "Koneksi database gagal : " . mysqli_connect_error();
}



function rupiah($angka)
{

	$hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
	return $hasil_rupiah;
}
function insertCart($data)
{
	$jumlah = htmlspecialchars($data["jumlah"]);
	$kode = htmlspecialchars($data["kode_produk"]);
	$nama = htmlspecialchars($data["nama_produk"]);
	$harga = htmlspecialchars($data["harga_produk"]);
	global $koneksi;

	$ambil = mysqli_query($koneksi, "SELECT * FROM cart WHERE kode = '$kode'");
	$hasil = mysqli_fetch_array($ambil);

	$result = mysqli_query($koneksi, "SELECT kode FROM cart WHERE kode = '$kode'");
	if (mysqli_fetch_assoc($result)) {
		$upJum = $hasil['jumlah'] + $jumlah;
		$query = "UPDATE cart SET jumlah = '$upJum', kode ='$kode', nama='$nama', harga='$harga' WHERE kode='$kode'";
		mysqli_query($koneksi, $query);
	} else {
		$sql = "INSERT INTO cart VALUES('','$jumlah', '$kode', '$nama', '$harga')";
		mysqli_query($koneksi, $sql);
	}


	return mysqli_affected_rows($koneksi);
}
function query($query)
{
	global $koneksi;
	$result = mysqli_query($koneksi, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}
function registrasi($data)
{
	global $koneksi;

	$email = $data["inputEmail"];
	$nama = $data["inputNama"];
	$notelp = $data["inputNomor"];
	$password =  $data["inputPassword"];


	// cek username sudah ada atau belum
	$result = mysqli_query($koneksi, "SELECT email FROM user WHERE email = '$email'");

	if (mysqli_fetch_assoc($result)) {
		echo "<script>
				alert('username sudah terdaftar!')
		      </script>";
		return false;
	}


	// cek konfirmasi password


	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// tambahkan userbaru ke database
	mysqli_query($koneksi, "INSERT INTO user VALUES(null, '$email', '$password', '$nama', '$notelp', 'pelanggan')");

	return mysqli_affected_rows($koneksi);
}
function ubahUser($data)
{
	global $koneksi;
	$id = htmlspecialchars($data["id"]);
	$email = htmlspecialchars($data["email"]);
	$nama = htmlspecialchars($data["nama"]);
	$notelp = htmlspecialchars($data["notelp"]);
	$role = htmlspecialchars($data["role"]);
	mysqli_query($koneksi, "UPDATE user SET email = '$email', nama = '$nama', no_telp = '$notelp', role = '$role' WHERE id = '$id'");
	mysqli_affected_rows($koneksi);
}

function buatPesanan($data)
{
	global $koneksi;
	$alamat = $data["alamat"];
	$id = $_SESSION['id'];
	$totalBayar = 0;
	$key = substr(md5(time()), 0, 16);

	foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) :
		$ambil = $koneksi->query("SELECT * FROM item WHERE id='$id_produk'");
		$row = $ambil->fetch_assoc();
		$harga = $row['harga'];
		$kode = $row['kode'];
		$nama = $row['nama'];
		$totalHarga = $jumlah * $row['harga'];
		$totalBayar += $totalHarga;

		mysqli_query($koneksi, "INSERT INTO cart VALUES(null, '$key', '$jumlah', '$kode', '$nama', '$harga', '$totalHarga')");
	endforeach;
	mysqli_query($koneksi, "INSERT INTO pesanan VALUES(null, '$id', '$key', '$alamat','$totalBayar', 'dipesan')");
	unset($_SESSION['keranjang']);
	return mysqli_affected_rows($koneksi);
}
function addBarang($data)
{
	global $koneksi;
	$kode = htmlspecialchars($data["kode"]);
	$nama = htmlspecialchars($data["nama"]);
	$kategori = htmlspecialchars($data["kategori"]);
	$harga = htmlspecialchars($data["harga"]);


	$gambar = upload($kategori);
	if (!$gambar) {
		return false;
	}
	mysqli_query($koneksi, "INSERT INTO item VALUE(null, '$kode', '$nama', '$harga', '$kategori/$gambar','$kategori')");
	return mysqli_affected_rows($koneksi);
}
function upload($kategori)
{

	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	// cek apakah tidak ada gambar yang diupload
	if ($error === 4) {
		echo "<script>
				alert('pilih gambar terlebih dahulu!');
			  </script>";
		return false;
	}

	// cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>
				alert('yang anda upload bukan gambar!');
			  </script>";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if ($ukuranFile > 1000000) {
		echo "<script>
				alert('ukuran gambar terlalu besar!');
			  </script>";
		return false;
	}

	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, '../assets/images/' . $kategori . '/'  . $namaFileBaru);

	return $namaFileBaru;
}
