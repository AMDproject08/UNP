<?php 
require 'functions.php';

if (isset ($_POST["register"]) ){

	if (registrasi ($_POST) > 0 ) {
		echo "<script>
				alert ('user baru telah di tambahkan')
			</script>";
	}else {
		mysqli_error($conn);
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Halaman Registrasi</title>
	<style>
		label {
			display: block;
		}
	</style>
</head>
<body>
<h1>Halaman Registrasi</h1>

<form action="" method="post">
	<ul>
		<li>
			<label for="username">username :</label>
			<input type="text" name="username">
		</li>
		<li>
			<label for="password">password :</label>
			<input type="password" name="password">
		</li>
		<li>
			<label for="password2">confirm password :</label>
			<input type="password" name="password2">
		</li>
		<li>
			<button type="submit" name="register">register</button>
		</li>
	</ul>

</form>


</body>
</html>