<!DOCTYPE html>
<html>
<head>
    <title>Daftar Mahasiswa</title>
</head>
<body>
    <h1>Daftar Mahasiswa</h1>
    <a href="index.php?page=create">Tambah Mahasiswa</a>
    <table border="1">
        <tr>
            <th>NPM</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Prodi</th>
            <th>Aksi</th>
        </tr>
        <?php
        $stmt = $mahasiswa->read();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            echo "<tr>";
            echo "<td>{$npm}</td>";
            echo "<td>{$nama}</td>";
            echo "<td>{$alamat}</td>";
            echo "<td>{$row['prodi']}</td>";
            echo "<td>";
            echo "<a href='index.php?page=edit&npm={$npm}'>Edit</a>";
            echo " | ";
            echo "<a href='index.php?page=delete&npm={$npm}' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\">Delete</a>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
