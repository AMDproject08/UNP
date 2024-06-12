<!DOCTYPE html>
<html>
<head>
    <title>CRUD Mahasiswa</title>
</head>
<body>
    <h2>Daftar Mahasiswa</h2>
    <a href="list.php">Lihat Daftar Mahasiswa</a>
    <h2>Tambah Mahasiswa Baru</h2>
    <form action="list.php" method="POST">
        <label>NPM:</label><br>
        <input type="text" name="npm"><br>
        <label>Nama:</label><br>
        <input type="text" name="nama"><br>
        <label>Alamat:</label><br>
        <textarea name="alamat"></textarea><br>
        <label>Prodi ID:</label><br>
        <input type="text" name="prodi_id"><br>
        <input type="submit" value="Tambah">
    </form>
</body>
</html>
