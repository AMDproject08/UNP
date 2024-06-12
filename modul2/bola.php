<!DOCTYPE html>
<html>
<head>
    <title>Program OOP PHP</title>
</head>
<body>
<h2>Hitung Luas dan Volume Bola</h2>
<form action="" method="post">
    Jari-jari: <input type="text" name="jari_jari"><br>
    <input type="submit" name="hitung_bola" value="Hitung">
</form>
<?php
class Bola {
    private $jariJari;

    public function __construct($jariJari) {
        $this->jariJari = $jariJari;
    }

    public function hitungLuas() {
        return 4 * M_PI * pow($this->jariJari, 2);
    }

    public function hitungVolume() {
        return (4 / 3) * M_PI * pow($this->jariJari, 3);
    }
}
if(isset($_POST['hitung_bola'])) {
    $jari_jari = $_POST['jari_jari'];

    $bola = new Bola($jari_jari);
    $luas_bola = $bola->hitungLuas();
    $volume_bola = $bola->hitungVolume();

    echo "<br>Luas Bola: $luas_bola<br>";
    echo "Volume Bola: $volume_bola<br>";
}
?>
</body>
</html>
