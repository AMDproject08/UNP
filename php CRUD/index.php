<?php 
session_start();

if(!isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");

//tombol cari di klik
if (isset($_POST["cari"]) ) {
	$mahasiswa = cari($_POST["keyword"]);
}


 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Halaman Admin</title>
	<style>
		h1 {
			font-family: sans-serif;

		}
		.table1 {
			font-family: sans-serif;
			color: #444;
			border-collapse: collapse;
			width: 30px;
			border: 1px solid #f2f5f7;
		}
		.table1 tr th {
			background: #35A9DB;
			color: #fff;
			font-weight: normal;
		}
		.table1, th, td {
			padding: 8px 50px;
			text-align: center;
		}
		.table1 tr:hover {
			background-color: #f5f5f5;
		}
		.table1 tr:nth-child(even) {
			background-color: #f2f2f2;
		}
		
		.search {
			  width: 40%;
			  box-sizing: border-box;
			  border: 2px solid #ccc;
			  border-radius: 2px;
			  font-size: 15px;
			  background-color: white;
			  background-position: 5px 5px; 
			  background-repeat: no-repeat;
			  padding: 5px 5px 5px 5px;
			  transition: width 0.4s ease-in-out;
		}
		.cari {
			width: 5%;
			  background-color: #1E90FF;
			  border: none;
			  color: white;
			  padding: 8px 8px;
			  text-decoration: none;
			  margin: 2px 2px;
			  cursor: pointer;
		}
		/*a:link, a:visited {
			  background-color: #f44336;
			  color: white;
			  padding: 5px 5px;
			  text-align: center;
			  text-decoration: none;
			  display: inline-block;
			}

			a:hover, a:active {
			  background-color: red;
			}
*/
		</style>
</head>
<body>
	<a href="logout.php">Logout</a>
<h1>Daftar Mahasiswa UNP Kediri</h1>

<a href="tambah.php">tambah data mhs</a>
<form action="" method="post">

	<input type="text" class="search" name="keyword" autofocus placeholder="search" autocomplete="off">
	<button type="submit" class="cari" name="cari">Cari</button>
	
</form>

<table class="table1">

<tr>
	<th>no.</th>
	<th>aksi</th>
	<th>gambar</th>
	<th>npm</th>
	<th>nama</th>
	<th>email</th>
	<th>prodi</th>
</tr>
<?php $i = 1; ?>
<?php foreach( $mahasiswa as $row): ?>


<tr>
	<td><?= $i; ?></td>
	<td>
		<a href="edit.php?id=<?= $row["id"]; ?>">edit</a> |
		<a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('hapus data?');">hapus</a>

	</td>
	<td><img src="img/<?= $row["gambar"]; ?>" width="50"></td>
	<td><?= $row["npm"]; ?></td>
	<td><?= $row["nama"]; ?></td>
	<td><?= $row["email"]; ?></td>
	<td><?= $row["prodi"]; ?></td>
</tr>
<?php $i++ ?>
<?php endforeach; ?>	
	
</table>



</body>
</html>