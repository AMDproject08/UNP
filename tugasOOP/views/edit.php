<!DOCTYPE html>
<html>
<head>
    <title>Edit Mahasiswa</title>
</head>
<body>
    <h1>Edit Mahasiswa</h1>
    <?php
    if (isset($_GET['npm'])) {
        $mahasiswa->npm = $_GET['npm'];
        $mahasiswa->readOne();

        if ($mahasiswa->nama != null) {
            $nama = $mahasiswa->nama;
            $alamat = $mahasiswa->alamat;
            $prodi_id = $mahasiswa->prodi_id;
        } else {
            echo "<p>Data tidak ditemukan.</p>";
            exit();
        }
    } else {
        echo "<p>Parameter npm tidak ditemukan.</p>";
        exit();
    }

    if ($_POST) {
        $mahasiswa->npm = $_POST['npm'];
        $mahasiswa->nama = $_POST['nama'];
        $mahasiswa->alamat = $_POST['alamat'];
        $mahasiswa->prodi_id = $_POST['prodi_id'];

        if ($mahasiswa->update()) {
            echo "<p>Mahasiswa berhasil diupdate.</p>";
        } else {
            echo "<p>Gagal mengupdate mahasiswa.</p>";
        }
    }
    ?>
    <form action="index.php?page=edit&npm=<?php echo $mahasiswa->npm; ?>" method="post">
        <input type="hidden" name="npm" value="<?php echo $mahasiswa->npm; ?>">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($nama, ENT_QUOTES, 'UTF-8'); ?>" required>
        <br>
        <label for="alamat">Alamat:</label>
        <textarea id="alamat" name="alamat" required><?php echo htmlspecialchars($alamat, ENT_QUOTES, 'UTF-8'); ?></textarea>
        <br>
        <label for="prodi_id">Prodi:</label>
        <select id="prodi_id" name="prodi_id">
            <?php
            $stmt = $mahasiswa->getProdiList();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $selected = ($prodi_id == $row['id']) ? 'selected' : '';
                echo "<option value='{$row['id']}' {$selected}>{$row['nama']}</option>";
            }
            ?>
        </select>
        <br>
        <input type="submit" value="Update">
    </form>
    <a href="index.php">Kembali</a>
</body>
</html>
