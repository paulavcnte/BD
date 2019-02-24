<?php
spl_autoload_register(function ($clase) {
    require_once "$clase.php";
}
);
session_start();
$user = $_SESSION['user'];
$pass = $_SESSION['pass'];
$host = $_SESSION['host'];
$bbdd = $_SESSION['bbdd'];


$id = $_SESSION['id'];
$nombreTabla = $_SESSION['nombreTab'];

echo "esto es el nombre de la tabla $nombreTabla";
//recogemos los nombres de las columnas de la tabla
$valor = [];
$valor = $_SESSION['valor'];
echo " valor $valor";
$bd = new BD($host, $user, $pass, $bbdd);
echo "$host, $user, $pass, $bbdd";
$bd->conectar();

//buscamos el valor con el campo, el nombre de la tabla  y el id
$valores =$bd ->buscaValores($valor, $nombreTabla, $id);
if (isset($_POST['submit'])) {
    switch ($_POST['submit']) {
        case 'guardar':
            $datos= [];
            $datos= $_POST['valor1'];
            
            if ($bd->update($valor, $nombreTabla, $id, $datos)) {
                header("Location:editar.php");
                exit();
            } else {
                $msj = "Error actualizando, ten encuenta las relaciones de integridad referencial  ";
            }
            break;
        case 'cancelar':
            header("Location:editar.php");
            exit();
            break;
       
    }
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Regristro tabla</title>
        <link rel="stylesheet" type="text/css" href="estilos.css">
    </head>
    <body>
        <header><h1><?php echo "$msj"; ?></h1></header>
        <fieldset style="width: 30%">
            <legend>Editando tabla <?php echo "$nombreTab"; ?></legend>
            <form action="gestionarTabla.php" method="POST">
                <?php
                foreach ($valores as $valor => $value) {
                    echo "<label>$valor</label><input type='text' name='valor1[]' value='$value'><br/>";
                }
                ?> 
                <input type="submit" name='submit' value="guardar">
                <input type="submit" name='submit' value="cancelar">
            </form>
        </fieldset>
    </body>
</html>