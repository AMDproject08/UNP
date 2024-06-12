<?php
class menghitung{
    function convertTB($t){
        $c =  $t/100;
        return $c*$c;
    }
    function calculate($b, $c){
        return round($b / $c, 1);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tglLhr']) && isset($_POST['jk']) && isset($_POST['t']) && isset($_POST['bb'])) {
    $hitung = new menghitung();

    $convert = $hitung->convertTB($_POST['t']);
    $calculate = $hitung->calculate($_POST['bb'], $convert);
    $response = [
        'status' => true,
        'bmi' => $calculate
    ];
} else {
    $response = [
        'status' => false,
        'message' => 'Input Kosong' 
    ];
}
echo json_encode($response);
?>