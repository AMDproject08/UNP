<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>konfersi nilai</title>
</head>
<body>
<h2>Konversi Nilai Angka ke Nilai Huruf</h2>
<form action="" method="post">
    Nilai Angka: <input type="text" name="nilai"><br>
    <input type="submit" name="konversi_nilai" value="Konversi">
</form>
<?php 
class KonversiNilai {
    public static function konversi($nilai) {
        if ($nilai >= 85) {
            return 'A';
        } elseif ($nilai >= 70) {
            return 'B';
        } elseif ($nilai >= 60) {
            return 'C';
        } elseif ($nilai >= 50) {
            return 'D';
        } else {
            return 'E';
        }
    }
}
if(isset($_POST['konversi_nilai'])) {
    $nilai = $_POST['nilai'];

    $nilai_huruf = KonversiNilai::konversi($nilai);
    echo "<br>Nilai Angka: $nilai, Nilai Huruf: $nilai_huruf<br>";
}


 ?>
</body>
</html>