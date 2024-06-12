<?php
require_once('database.php');

$mahasiswa = new Mahasiswa();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $npm = $_POST['npm'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $prodi_id = $_POST['prodi_id'];

    $tambah = $mahasiswa->tambahMahasiswa($npm, $nama, $alamat, $prodi_id);

    if ($tambah) {
        echo "Mahasiswa berhasil ditambahkan.";
    } else {
        echo "Gagal menambahkan mahasiswa.";
    }
}

$result = $mahasiswa->getMahasiswa();

if ($result) {
    echo "<h2>Daftar Mahasiswa</h2>";
    while ($row = $result->fetch_assoc()) {
        echo "NPM: " . $row["npm"] . " - Nama: " . $row["nama"] . " - Alamat: " . $row["alamat"] . " - Prodi ID: " . $row["prodi_id"] . "<br>";
    }
} else {
    echo "Tidak ada data mahasiswa.";
}
?>
