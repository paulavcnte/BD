
<?php
//Función para auto carga de clases siguiendo las buenas prácticas de programación
spl_autoload_register(function ($clase) {
    require_once "$clase.php";
}
);
session_start();

//Si paso parámetros de conexión los leo

$user = $_POST["user"];
$pass = $_POST["pass"];
$host = $_POST["host"];
$bbdd = $_POST["bbdd"];

$_SESSION['host'] = $_POST['host'];
$_SESSION['user'] = $_POST['user'];
$_SESSION['pass'] = $_POST['pass'];

if (isset($_POST['gestion'])) {
    $bbdd = $_POST["bbdd"];

    $_SESSION['bbdd'] = $bbdd;
}

$_SESSION['host'] = 'localhost';
$_SESSION['user'] = 'root';
$_SESSION['pass'] = 'root';


echo "$user, $pass,$host";

$bd = new BD($host, $user, $pass);
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Ejemplo de estilos CSS en un archivo externo</title>
        <link rel="stylesheet" type="text/css" href="estilo.css" media="screen" />
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <fieldset id="sup"style="width:70%">
            <legend>Datos de conexión</legend>
            <form action="index.php" method="POST">
                <label for="host">Host</label>
                <input type="text" name="host" value="" id="">
                <label for="user">Usuario</label>
                <input type="text" name="user" value="" id="">
                <label for="pass">Password</label>
                <input type="text" name="pass" value="" id="">
                <input type="submit" value="Conectar" name="conectar">
            </form>

        </fieldset>

        <?php
        if ($_POST['conectar']) {
            $t = [];
            $verbbdd = $bd->verbasesdedatos();
            // var_dump($verbbdd);
            foreach ($verbbdd as $v) {
                $t[] = $v['Database'];
            }
            //  var_dump($t);
            ?>
            <fieldset style="width:70%">
                <legend>Gestion de las Bases de Datos del host </legend>
                <form action="tablas.php" method="POST">
                    <?php
                    foreach ($t as $bbdd) {
                        echo "<input type=radio value=$bbdd name=bbdd>";
                        echo "<label>$bbdd</label><br />";
                        // echo "<a href='tablas.php?bbdd=$bbdd'>$bbdd</a><br/>";
                    }
                    ?>
                    <input type="submit" value="Gestionar" name="gestion">
                </form>
            </fieldset>
        <?php } ?>


    </body>
</html>