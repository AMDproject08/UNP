<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mahasiswa</title>
</head>
<body>
    <h1>Tambah Mahasiswa</h1>
    <form action="index.php?page=create" method="post">
        <label for="npm">NPM:</label>
        <input type="text" id="npm" name="npm" required>
        <br>
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required>
        <br>
        <label for="alamat">Alamat:</label>
        <textarea id="alamat" name="alamat" required></textarea>
        <br>
        <label for="prodi_id">Prodi:</label>
        <select id="prodi_id" name="prodi_id">
            <?php
            $stmt = $mahasiswa->getProdiList();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$row['id']}'>{$row['nama']}</option>";
            }
            ?>
        </select>
        <br>
        <input type="submit" value="Tambah">
    </form>
    <a href="index.php">Kembali</a>
    <?php
    if ($_POST) {
        $mahasiswa->npm = $_POST['npm'];
        $mahasiswa->nama = $_POST['nama'];
        $mahasiswa->alamat = $_POST['alamat'];
        $mahasiswa->prodi_id = $_POST['prodi_id'];

        if ($mahasiswa->create()) {
            echo "<p>Mahasiswa berhasil ditambahkan dengan NPM: {$mahasiswa->npm}.</p>";
        } else {
            echo "<p>Gagal menambahkan mahasiswa. Pastikan NPM tidak duplikat.</p>";
        }
    }
    ?>
</body>
</html>
