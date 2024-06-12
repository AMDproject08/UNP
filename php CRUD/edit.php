<?php 
session_start();

if(!isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'functions.php';

//ambil data di URL
$id= $_GET["id"];
//query data mahasiswa berdasarkan id
$mhs= query("SELECT * FROM mahasiswa WHERE id = $id")[0];


//cek tombol submit
if (isset($_POST["submit"]) ) {
	
	//cek data sudah berhasil di edit / gagal
	if (edit ($_POST) > 0) {
		echo "
			<script>
				alert('data berhasil di edit');
				document.location.href = 'index.php';
			</script>
		";
	}else {
		echo "
			<script>
				alert('data gagal di edit');
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
	<title>Edit Data</title>
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
<h1>Edit Data Mahasiswa</h1>
<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
	<input type="hidden" name="gbrLama" value="<?= $mhs["gambar"]; ?>">
	
			<label for="nama">nama :</label><br>
			<input class="input" type="text" name="nama" id="nama" required value="<?= $mhs["nama"]; ?>">
			<br>
		
			<label for="npm">npm :</label><br>
			<input class="input" type="text" name="npm" id="npm" required value="<?= $mhs["npm"]; ?>">
			<br>
		
			<label for="email">email :</label><br>
			<input class="input" type="text" name="email" id="email" required value="<?= $mhs["email"]; ?>">
			<br>
		
			<label for="prodi">prodi :</label><br>
			<input class="input" type="text" name="prodi" id="prodi" required value="<?= $mhs["prodi"]; ?>">
			<br>
		
			<label for="gambar">gambar :</label> <br>
			<img src="img/<?= $mhs['gambar']; ?>" width="80"> <br>
			<input class="input" type="file" name="gambar" id="gambar"><br>
		
			<button class="submit" type="submit" name="submit">Edit</button>
		

</form>
</div>

</body>
</html>