<!DOCTYPE html>
<html>
<head>
    <title>Hitung Balok</title>
</head>
<body>
   <h2>Hitung Luas dan Volume Balok</h2>
<form action="" method="post">
    Panjang: <input type="text" name="panjang"><br>
    Lebar: <input type="text" name="lebar"><br>
    Tinggi: <input type="text" name="tinggi"><br>
    <input type="submit" name="hitung_balok" value="Hitung">
</form>
<?php
class Balok {
    private $panjang;
    private $lebar;
    private $tinggi;

    public function __construct($panjang, $lebar, $tinggi) {
        $this->panjang = $panjang;
        $this->lebar = $lebar;
        $this->tinggi = $tinggi;
    }

    public function hitungLuas() {
        return 2 * (($this->panjang * $this->lebar) + ($this->panjang * $this->tinggi) + ($this->lebar * $this->tinggi));
    }

    public function hitungVolume() {
        return $this->panjang * $this->lebar * $this->tinggi;
    }
}
if(isset($_POST['hitung_balok'])) {
    $panjang = $_POST['panjang'];
    $lebar = $_POST['lebar'];
    $tinggi = $_POST['tinggi'];

    $balok = new Balok($panjang, $lebar, $tinggi);
    $luas_balok = $balok->hitungLuas();
    $volume_balok = $balok->hitungVolume();

    echo "<br>Luas Balok: $luas_balok<br>";
    echo "Volume Balok: $volume_balok<br>";
}
?>

</body>
</html>
