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


$bd = new BD($host, $user, $pass, $bbdd);
$bd->conectar();

$valores = $bd->muestraValores($nombreTabla);

$cabecera=[];

$cabecera =$bd->muestraCampos($nombreTabla);

$_SESSION['valor']=$cabecera;

    $id = $_POST['id'];
    var_dump($id);
if (isset($_POST['submit'])) {
    switch ($_POST['submit']) {
        case 'editar':
            $_SESSION['id'] = $_POST['id'];
            $_SESSION['nombreTab'] = $_POST['nombreTab'];
            
            $_SESSION['valor']=$cabecera;
            header("Location:gestionarTabla.php");
            exit();
            break;
        case 'eliminar':
            $id = $_POST['id'];
            $nombreTa = $_POST['nombreTab'];
        
            $eliminada = $bd->eliminarFila($cabecera[0], $nombreTa, $id);
            if ($eliminada == true) {
                $msj = "Se ha eliminado una fila";
            } else {
                $msj = "No se puede eliminar la fila seleccionada";
            }
            break;
            
        case 'insertar':
            $_SESSION['nombreTab'] = $nombreTab;
            header("Location:insertar.php");
            exit();
            break;
        case 'atras':
            header("Location:tablas.php");
            exit();
            break;
        
        
    }
} 
?>



<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <style>
            table, tr, td, th{
                border: 1px solid ;

            }

        </style>
    </head>
    <body>
        <h2><?php echo "$msj"; ?></h2>
        <table>
            <?php
             echo " <tr>";
                foreach ($cabecera as $value) {
                    echo "<td>$value</th>";
                }
                echo "<td></td><td></td></tr>   ";
               

            foreach ($valores as $val => $value) {

                      for ($cont = 0; $cont < count($value); $cont++) {
                            echo "<td>$value[$cont]";
                        }
                      echo "</td><td><form action = 'editar.php' method = 'POST'><input type ='hidden' name ='id' value ='$value[0]'>"
                        . " <input type = 'hidden' name = 'nombreTab' value = '$nombreTabla'>"
                        . " <input type = 'submit' name = 'submit' value = 'editar'></form>"
                        . " </td>"
                        . " <td><form action = 'editar.php' method = 'POST'><input type = 'hidden' name = 'id' value = '$value[0]'>"
                        . " <input type = 'hidden' name = 'nombreTab' value = '$nombreTabla'>"
                        . " <input type = 'submit' name = 'submit' value = 'eliminar'></form></td><tr/>";
                   
            }
            ?>
        </table>
        <form action="editar.php" method="POST" >
                    <input type="submit" name="submit" value="insertar">
                    <input type="submit" name="submit" value="atras">
                </form>
    </body>
</html>