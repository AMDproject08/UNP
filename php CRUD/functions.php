<?php 
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

//mengambil isi database
function query($query) {
	global $conn;
	$result = mysqli_query($conn,$query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

//function tambah data
function tambah ($data) {
	global $conn;

	//ambil data dari form
	$nama = htmlspecialchars ($data["nama"]);
	$npm = htmlspecialchars ($data["npm"]);
	$email = htmlspecialchars  ($data["email"]);
	$prodi = htmlspecialchars ($data["prodi"]);
	//upload gambar dulu
	$gambar = upload();
	if (!$gambar) {
		return false;
	}

	//query insert data
	$query = "INSERT INTO Mahasiswa
				VALUES ('', '$nama', '$npm', '$email', '$prodi', '$gambar') ";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}

function upload() {
	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	//1. cek ada gmbr yg di upload tidak..?
	if ($error === 4) {
		echo "<script>
			alert('upload gambar terlebih dahulu!');
		</script>";
		return false;
	}

	//2. cek yg boleh di upload hanya gambar
	$gambarValid = ['jpg','jpeg','png'];
	$ekstensiGambar = explode('.',$namaFile);
	$ekstensiGambar = strtolower(end ($ekstensiGambar) );
	if (!in_array($ekstensiGambar,$gambarValid) ) {
		echo "<script>
			alert('yang anda upload BUKAN gambar!');
		</script>";
		return false;
	}

	//3. cek jika ukuran file terlalu besar
	if($ukuranFile > 3000000) {
		echo "<script>
			alert('ukuran file gambar terlalu besar!');
		</script>";
		return false;
	}

	//4. Lolos pengecekan, gambar siap di upload
		// generate nama gambar baru
		$namaBaru = uniqid();
		$namaBaru .= '.';
		$namaBaru .= $ekstensiGambar;
	move_uploaded_file($tmpName, 'img/' . $namaBaru);
	return $namaBaru;


}


//functions hapus
function hapus($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
	return mysqli_affected_rows($conn);
}

// function edit data
function edit($data) {
global $conn;

	//ambil data dari form
	$id = $data["id"];
	$nama = htmlspecialchars ($data["nama"]);
	$npm = htmlspecialchars ($data["npm"]);
	$email = htmlspecialchars  ($data["email"]);
	$prodi = htmlspecialchars ($data["prodi"]);
	$gbrLama = htmlspecialchars ($data["gbrLama"]);

	//cek user klik tombol upload atau tidak
	if($_FILES['gambar']['error'] === 4) {
		$gambar = $gbrLama;
	}else {
		$gambar = upload();
	}

	

	//query insert data
	$query = "UPDATE mahasiswa SET 
				nama = '$nama',
				npm = '$npm',
				email = '$email',
				prodi = '$prodi',
				gambar = '$gambar'
			WHERE id = $id
	";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

//functions cari
function cari($keyword) {
	$query = "SELECT * FROM mahasiswa
		WHERE
		nama LIKE '%$keyword%' OR
		npm LIKE '%$keyword%' OR
		email LIKE '%$keyword%' OR
		prodi LIKE '%$keyword%'
	";
return query($query);

}
//functions registrasi
function registrasi($data) {
	global $conn;

	$username = strtolower(stripcslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

	//cek username sudah ada atau belum
	$result = mysqli_query ($conn, "SELECT username FROM user WHERE username = '$username' ");
		if (mysqli_fetch_assoc($result) ) {
			echo "<script>
				alert ('user sudah terdaftar')
			</script>";
			return false;
		}

	//cek konfirmasi password
	if ($password !== $password2){
		echo "<script>
				alert ('konfirmasi password salah')
			</script>";
			return false;
	}
	//enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// masukkan ke database
	mysqli_query ($conn, "INSERT INTO user VALUES ('','$username','$password')");

	return mysqli_affected_rows($conn);


}

 ?>