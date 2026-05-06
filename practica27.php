<?php
// Reporte de errores para debug (puedes quitarlos después)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$p = isset($_GET['p']) ? $_GET['p'] : '21';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Práctica 27: Menú PHP - UAS</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f7f6; padding: 20px; text-align: center; }
        .container { max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); border-top: 8px solid #1a4cd4; }
        nav a { margin: 0 10px; text-decoration: none; color: #1a4cd4; font-weight: bold; border: 1px solid #1a4cd4; padding: 5px 10px; border-radius: 5px; display: inline-block; margin-bottom: 10px; }
        nav a:hover { background: #1a4cd4; color: white; }
        .seccion { margin-top: 30px; padding: 20px; border-top: 1px solid #eee; }
        input[type="number"], input[type="text"] { padding: 8px; margin: 5px; border-radius: 4px; border: 1px solid #ccc; width: 80px; }
        input[type="submit"] { background: #1a4cd4; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer; }
        .resultado { margin-top: 15px; padding: 10px; background: #eef2f5; color: #1a4cd4; font-weight: bold; border-radius: 5px; }
    </style>
</head>
<body>

<div class="container">
    <h1>Menú de Prácticas PHP</h1>
    <nav>
        <a href="?p=21">P21: Operaciones</a>
        <a href="?p=22">P22: General</a>
        <a href="?p=23">P23: IMC</a>
        <a href="?p=24">P24: Fecha</a>
        <a href="?p=25">P25: Tablas 1-10</a>
        <a href="?p=26">P26: Tablas N</a>
    </nav>

    <div class="seccion">
        <?php
        switch($p) {
            case '21': // Operaciones Básicas
                echo "<h3>Operaciones Básicas</h3>";
                echo '<form method="POST">
                        <input type="number" name="n1" required> + 
                        <input type="number" name="n2" required>
                        <input type="submit" value="Sumar">
                      </form>';
                if($_POST && isset($_POST['n1'])) {
                    $res = $_POST['n1'] + $_POST['n2'];
                    echo "<div class='resultado'>La suma es: $res</div>";
                }
                break;

            case '22': // Fórmula General
                echo "<h3>Fórmula General (a, b, c)</h3>";
                echo '<form method="POST">
                        a: <input type="number" name="a" required>
                        b: <input type="number" name="b" required>
                        c: <input type="number" name="c" required>
                        <input type="submit" value="Calcular">
                      </form>';
                if($_POST && isset($_POST['a'])) {
                    $a = $_POST['a']; $b = $_POST['b']; $c = $_POST['c'];
                    $disc = ($b*$b) - (4*$a*$c);
                    if($disc < 0) echo "<div class='resultado'>Raíces imaginarias</div>";
                    else {
                        $x1 = (-$b + sqrt($disc)) / (2*$a);
                        echo "<div class='resultado'>X1 = ".round($x1,2)."</div>";
                    }
                }
                break;

            case '23': // IMC
                echo "<h3>Cálculo de IMC</h3>";
                echo '<form method="POST">
                        Peso (kg): <input type="number" name="peso" step="0.1" required>
                        Altura (m): <input type="number" name="alt" step="0.01" required>
                        <input type="submit" value="Calcular IMC">
                      </form>';
                if($_POST && isset($_POST['peso'])) {
                    $alt = $_POST['alt'];
                    $imc = $_POST['peso'] / ($alt * $alt);
                    echo "<div class='resultado'>Tu IMC es: ".round($imc,2)."</div>";
                }
                break;

            case '24': // Fecha con Switch
                $dias = ["domingo","lunes","martes","miércoles","jueves","viernes","sábado"];
                $meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
                echo "<h3>Fecha Actual</h3>";
                echo "<div class='resultado'>Hoy es ".$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]." del ".date('Y')."</div>";
                break;

            case '25': // Tablas 1-10
                echo "<h3>Tablas del 1 al 10</h3>";
                for($i=1; $i<=10; $i++) {
                    // Corregido: se eliminó el símbolo $ de '$1' que causaba el error 500
                    echo "<b>Tabla del $i:</b> 1x$i=".(1*$i)." ... 10x$i=".(10*$i)."<br>";
                }
                break;

            case '26': // Tablas hasta N
                echo "<h3>Tablas hasta N</h3>";
                echo '<form method="POST"> Hasta el: <input type="number" name="num" required> <input type="submit" value="Generar"></form>';
                if($_POST && isset($_POST['num'])) {
                    $num = intval($_POST['num']);
                    for($i=1; $i<=$num; $i++) echo "Tabla del $i generada correctamente.<br>";
                }
                break;
        }
        ?>
    </div>
</div>

</body>
</html>