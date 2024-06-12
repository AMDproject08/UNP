<!DOCTYPE html>
<html>
<head>
    <title>Konversi Nilai Mata Kuliah</title>
</head>
<body>
    <h2>Konversi Nilai Mata Kuliah</h2>
    <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?> ">
        <label for="nilai">Masukkan nilai (0-100):</label>
        <input type="text" id="nilai" name="nilai" required>
        <input type="submit" value="Konversi">
    </form>

    
</body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nilai = $_POST['nilai'];
        $hasil_konversi = '';

        if (is_numeric($nilai) && $nilai >= 0 && $nilai <= 100) {
            if ($nilai >= 80) {
                $hasil_konversi = 'A';
            } elseif ($nilai >= 70) {
                $hasil_konversi = 'B';
            } elseif ($nilai >= 60) {
                $hasil_konversi = 'C';
            } elseif ($nilai >= 50) {
                $hasil_konversi = 'D';
            } else {
                $hasil_konversi = 'E';
            }
        } else {
            $hasil_konversi = 'Masukkan nilai antara 0 dan 100';
        }

        echo "<p>Hasil konversi nilai: $hasil_konversi</p>";
    }
?>