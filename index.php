<!DOCTYPE html>
<?php
//Función para auto carga de clases siguiendo las buenas prácticas de programación
spl_autoload_register(function ($clase) {
  require_once "$clase.php";
}
);
session_start();
 
//Si paso parámetros de conexión los leo
$datosConexión = [];
 $user = $_POST["user"];
 $pass = $_POST["pass"];
 $host = $_POST["host"];
$_SESSION['host'] = $_POST['host'];
$_SESSION['user'] = $_POST['user'];
$_SESSION['pass'] = $_POST['pass'];
 
  $_SESSION['host'] = 'localhost';
  $_SESSION['user'] = 'root';
  $_SESSION['pass'] = '';


$bd = new BD("$host", "$user", "$pass" );


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
            <form action="." method="POST">
                <label for="host">Host</label>
                <input type="text" name="host" value="localhost" id="">
                <label for="usuario">Usuario</label>
                <input type="text" name="user" value="root" id="">
                <label for="pass">Password</label>
                <input type="text" name="pass" value="root" id="">
                <input type="submit" value="Conectar" name="conectar">
            </form>
 
        </fieldset>
        
        <?php
       if ($_POST['conectar']) {
          $verbbdd = $bd->verbasesdedatos();
          var_dump($verbbdd);
          $bbdd = $value['verbbdd'];
         
          ?>
          <fieldset style="width:70%">
              <legend>Gestion de las Bases de Datos del host </legend>
              <form action="tablas.php" method="post">
                  <?php
                   
                    
                    echo "<input type=radio value=$bbdd name=basedatos>";
                   echo "<label for=basedatos>$bbdd</label><br />";
                  
                  $bd->cerrar();
                  ?>
                  <input type="submit" value="Gestionar">
              </form>
          </fieldset>
       <?php }?>
        
        
    </body>
</html>