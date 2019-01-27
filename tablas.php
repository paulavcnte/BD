<?php
spl_autoload_register(function ($clase) {
    require_once "$clase.php";
}
);

session_start();

$user = $_SESSION['user'];
$pass = $_SESSION['pass'];
$host = $_SESSION['host'];
////$bbdd = $_SESSION['bbdd'];
$bbdd = $_GET['bbdd'];

echo "$user, $pass,$host , $bbdd";



$bd = new BD2($host, $user, $pass, $bbdd);
$bd->conectar();


$mostrar = $bd->mostrarTablas();

$t = [];
foreach ($mostrar as $v) {
    $t[] = $v['Tables_in_' . $bbdd];
}




if (isset($_POST['nombreTabla'])) {
    $nombreTabla = $_POST['nombreTabla'];
    $_SESSION['nombreTabla'] = $nombreTabla;

    $_SESSION['user'] = $user;
    $_SESSION['pass'] = $pass;
    $_SESSION['host'] = $host;
    $_SESSION['bbdd'] = $bbdd;
    
 
    header("Location:editar.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
    </head>
    <body>
        <form action="tablas.php" method="POST">
            <?php
            foreach ($t as $value) {
                echo "$t";

                echo" <input type='submit' name='nombreTabla' value='$value'>";
            }
            ?>
        </form>
    </body>
</html>