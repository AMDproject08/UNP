<!DOCTYPE html>
<html>
<head>
    <title>Kalkulator Sederhana</title>
</head>
<body>
    <h2>Kalkulator Sederhana</h2>
    <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']);?>">
        <input type="text" name="num1" placeholder="angka pertama" required><br><br>
        <select name="operator" required>
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select><br><br>
        <input type="text" name="num2" placeholder="angka kedua" required><br><br>
        <input type="submit" value="Hitung">
    </form>
    </body>
</html>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $operator = $_POST['operator'];
        $result = '';

        if (is_numeric($num1) && is_numeric($num2)) {
            switch ($operator) {
                case "+":
                    $result = $num1 + $num2;
                    break;
                case "-":
                    $result = $num1 - $num2;
                    break;
                case "*":
                    $result = $num1 * $num2;
                    break;
                case "/":
                    if ($num2 != 0) {
                        $result = $num1 / $num2;
                    } else {
                        $result = "Tidak bisa dibagi dengan nol";
                    }
                    break;
                default:
                    $result = "Operator tidak valid";
            }
        } else {
            $result = "Masukkan angka yang valid";
        }

        echo "<p>Hasil: $result</p>";
    }

 ?>
