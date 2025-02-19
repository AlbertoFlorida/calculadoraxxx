<?php

require_once 'src/Calculadora.php';

use App\Calculadora;

$resultado = null;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num1 = $_POST['num1'] ?? null;
    $num2 = $_POST['num2'] ?? null;
    $operacion = $_POST['operacion'] ?? null;

    $calculadora = new Calculadora();

    if (!is_numeric($num1) || ($operacion !== 'raiz' && (!is_numeric($num2) || empty($num2)))) {
        $error = 'Introduzca valores válidos.';
    } else {
        switch ($operacion) {
            case 'suma':
                $resultado = $calculadora->suma($num1, $num2);
                break;
            case 'resta':
                $resultado = $calculadora->resta($num1, $num2);
                break;
            case 'multiplicacion':
                $resultado = $calculadora->multiplicacion($num1, $num2);
                break;
            case 'division':
                $resultado = $calculadora->division($num1, $num2);
                break;
            case 'raiz':
                $resultado = $calculadora->raiz($num1);
                break;
            default:
                $error = 'Error.';
        }
    }
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Calculadora</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="calculator">
        <h2>Calculadora</h2>
        <form method="POST">
            <input type="text" name="num1" placeholder="Número 1">
            <input type="text" name="num2" placeholder="Número 2 hol">
            <select name="operacion">
                <option value="suma">Suma</option>
                <option value="resta">Resta</option>
                <option value="multiplicacion">Multiplicación</option>
                <option value="division">División</option>
                <option value="raiz">Raíz</option>
            </select>
            <button type="submit">Calcular</button>
        </form>
        <div class="result-container">
            <?php if ($error): ?>
                <p style="color:red;"><?= $error ?></p>
            <?php elseif ($resultado !== null): ?>
                <p>Resultado: <?= $resultado ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>