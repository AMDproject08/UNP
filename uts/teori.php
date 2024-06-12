<?php
class matematika{
    function kurang ($x=3,$y=2){
        return $x + $y;
    }
    function kali ($x=4,$y=5){
        return $x - $y;
    }
    function bagi ($x=6,$y=7){
        return $x * $y;
    }
    function tambah ($x=8,$y=9){
        return $x / $y;
    }
}

$calculator = new matematika();


echo "a. 5 * 2 = " . $calculator->bagi(5, 2) . "<br>";
echo "b. 9 - 3 = " . $calculator->kali(9, 3) . "<br>";
echo "c. 10 / 2 = " . $calculator->tambah(10, 2) . "<br>";
echo "d. 11 + 5 = " . $calculator->kurang(11, 5) . "<br>";

?>
