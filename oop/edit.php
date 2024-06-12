<!DOCTYPE html>
<html>
<head>
    <title>Edit Mahasiswa</title>
</head>
<body>
    <h2>Edit Mahasiswa</h2>
    <form action="edit.php" method="POST">
        <label>NPM:</label><br>
        <input type="text" name="npm"><br>
        <label>Nama:</label><br>
        <input type="text" name="nama"><br>
        <label>Alamat:</label><br>
        <textarea name="alamat"></textarea><br>
        <label>Prodi ID:</label><br>
        <input type="text" name="prodi_id"><br>
        <input type="submit" value="Simpan">
    </form>
</body>
</html>
