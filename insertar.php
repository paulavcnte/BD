<?php
spl_autoload_register(function($clase) {
    require_once "$clase.php";
});
session_start();
//recuperamos el nombre de la tabla y los nombres de las columnas
$nombreTabla = $_SESSION['nombreTabla'];
$valor = [];
$valor = $_SESSION['valor'];
//conexiones
$user = $_SESSION['user'];
$pass = $_SESSION['pass'];
$host = $_SESSION['host'];
$bbdd = $_SESSION['bbdd'];

$bd = new BD($host, $user, $pass, $bbdd);
$bd->conectar();
$msj = "";
if (isset($_POST['submit'])) {
    switch ($_POST['submit']) {
        case 'guardar':
            $datos = [];
            $datos = $_POST['valor1'];
            $ok = $bd->insert($valor, $nombreTabla, $datos);
            if ($ok) {
                header("Location:editar.php");
                exit();
            } else {
                $msj = "No se ha podido actualizar";
            }
            break;
        case 'cancelar':
            header("Location:editar.php");
            exit();
            break;
        default:
            break;
    }
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Insertar</title>
        <link rel="stylesheet" type="text/css" href="estilos.css">
    </head>
    <body>
        <header><h1><?php echo "$msj"; ?></h1></header>
        <fieldset>
            <legend>Insertar datos en la tabla <?php echo "$nombreTabla"; ?></legend>
            <form action="insertar.php" method="POST">
                <?php
                for ($valores = 0; $valores < count($valor); $valores++) {
                    echo "<label>$valor[$valores]</label><input type='text' name='valor1[]' value=><br/>";
                }
                ?> 
                <input type="submit" name='submit' value="guardar">
                <input type="submit" name='submit' value="cancelar">
            </form>
        </fieldset>
    </body>
</html>
