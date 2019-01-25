<?php
spl_autoload_register(function ($clase) {
    require_once "$clase.php";
}
);



session_start();

$nombreTabla = $_SESSION['nombreTabla'];
$user = $_SESSION['user'];
$pass = $_SESSION['pass'];
$host = $_SESSION['host'];
$bbdd = $_SESSION['bbdd'];


$bd = new BD2($host, $user, $pass, $bbdd);
$bd->conectar();


$consulta = "select * from $nombreTabla";
$c = $bd->mostrarDatos($consulta);
?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
    </head>
    <body>
        <?php
        foreach ($c as $value) {

            echo "<tr><td>$value[0]</td><td>$value[2]</td><td>Editar</a></td></tr>";
        }
        ?>
    </body>
</html>