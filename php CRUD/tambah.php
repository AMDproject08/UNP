<?php 
session_start();

if(!isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'functions.php';
//cek tombol submit
if (isset($_POST["submit"]) ) {
	
	//cek data sudah berhasil masuk / gagal
	if (tambah ($_POST) > 0) {
		echo "
			<script>
				alert('data berhasil di tambahkan');
				document.location.href = 'index.php';
			</script>
		";
	}else {
		echo "
			<script>
				alert('data gagal di tambahkan');
				document.location.href = 'index.php';
			</script>
		";
	}

}


 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tambah Data</title>
	<style>
		.input, select {
		  width: 30%;
		  padding: 12px 20px;
		  margin: 8px 0;
		  display: inline-block;
		  border: 1px solid #ccc;
		  border-radius: 4px;
		  box-sizing: border-box;
		}
		.submit {
		  width: 30%;
		  background-color: #1E90FF;
		  color: white;
		  padding: 14px 20px;
		  margin: 8px 0;
		  border: none;
		  border-radius: 4px;
		  cursor: pointer;
		}

		.submit :hover {
		  background-color: #45a049;
		}

		div {
		  border-radius: 5px;
		  background-color: #f2f2f2;
		  padding: 20px;
		  font-family: sans-serif;
		}
	</style>
</head>
<body>

<div>
	<h1>Tambah Data Mahasiswa</h1>
<form action="" method="post" enctype="multipart/form-data">
	
			<label for="nama">nama :</label><br>
			<input class="input" type="text" name="nama" id="nama" required><br>
		
			<label for="npm">npm :</label><br>
			<input class="input" type="text" name="npm" id="npm" required><br>
		
			<label for="email">email :</label><br>
			<input class="input" type="text" name="email" id="email" required><br>
		
			<label for="prodi">prodi :</label><br>
			<input class="input" type="text" name="prodi" id="prodi" required><br>
		
			<label for="gambar">gambar :</label><br>
			<input  class="input" type="file" name="gambar" id="gambar" required><br>
		
			<button class="submit" type="submit" name="submit">Tambah</button>

</form>
</div>

</body>
</html>