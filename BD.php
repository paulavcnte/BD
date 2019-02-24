<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BD
 *
 * @author alumno
 */
class BD {

//Es la conexion null o mysqli

    private $con; //conexion
    private $host;
    private $user;
    private $pass;
    private $bd;
    

    public function __construct($host, $user, $pass, $bd="") {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
         if ($bd != "") { //si es disinto de vacio lo inicializo
            $this->bd = $bd;
            $this->con = $this->conectar();
        }
    }

  public function conectar() {
        try {
            $conexion = new PDO("mysql:host=" . $this->host . "; dbname=$this->bd", $this->user, $this->pass);

            return $conexion;
        } catch (PDOException $p) {
            echo "Error " . $p->getMessage() . "<br />";
        }
    }

    public function mostrarTablas() {
        $filas = [];


        $resultado = $this->con->prepare("show full tables");
        $resultado->execute();
        while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $filas[] = $fila;
        }
        return $filas;
    }

    public function muestraValores(string $nombreTabla): array {

        $consulta = $this->con->query("select * from $nombreTabla");

        $datos = [];

//        echo " " . $this->con->errorCode();
        while ($f = $consulta->fetch(PDO::FETCH_NUM)) {
            ;
            $datos[] = $f;
        }
        return $datos;
    }
    
     public function muestraCampos(string $nombreTabla):array {

        $consulta = $this->con->query("select * from $nombreTabla");
        $nombre_tabla = null;
        $total_column = $consulta->columnCount();

        for ($counter = 0; $counter < $total_column; $counter ++) {
            $meta = $consulta->getColumnMeta($counter);
            $nombre_tabla[] = $meta['name'];
        }
        return $nombre_tabla;
    }
     
    
     public function eliminarFila(string $cabecera, string $nombreTabla, string $id) {
        $consulta = $this->con->prepare("delete from $nombreTabla where $cabecera='$id'");
        
        if ($consulta->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function verbasesdedatos() {
        try {
            echo "$this->host, $this->user, $this->pass<br/>";
            $conexion = new PDO("mysql:host=" . $this->host, $this->user, $this->pass);

            $sentencia = $conexion->prepare("show databases");
            $sentencia->execute();

            while ($fila = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                $filas[] = $fila;
            }
            return $filas;
        } catch (PDOException $p) {
            echo "Error " . $p->getMessage() . "<br />";
        }
    }

    public function buscaValores(array $valor, string $nombreTabla, $id ){
        $consulta = $this->con->prepare("select * from $nombreTabla where $valor[0] ='$id'");
        $consulta->execute();
        while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
            return $fila;
        }
    }
    
   
     public function update(array $valor, string $nombreTabla, $id, array $datos) {
    
        $consulta = "update $nombreTabla set ";
        //recuperamos el mnombre de la columna y el valor
        for ($valores = 0; $valores< count($valor); $valores++) {
            $consulta .= $valor[$valores] . "='$datos[$valores]', ";
        }
        //borramos la ultima coma ","
        $consulta = substr($consulta, 0, -2);
        $consulta .= " where $valor[0] = '$id'";
        //ejecutamos la sentencia
        $ejecutar = $this->con->prepare($consulta);
        if ($ejecutar->execute() === true) {
            return true;
        }
    }
    
    public function insert(array $valor, string $nombreTabla, array $valores) {
        //iremos construyendo la sentencia segun los valores que tengamos
        $consulta = "insert into $nombreTabla (";
        for ($datos = 0; $datos < count($valor); $datos++) {
            $consulta .= $valor[$datos] . ", ";
        }
        $consulta = substr($consulta, 0, -2); //borramos la ultima coma ","
        //ahora seguimos, concatemos el values 
        $consulta .= ") values(";
        //concatenamos los valores a insertar
        for ($datos = 0; $datos < count($valores); $datos++) {
            $consulta .= "'" . $valores[$datos] . "', ";
        }
        $consulta = substr($consulta, 0, -2); //borramos la ultima coma ","
        $consulta .= ")";
        $ejecutar = $this->con->prepare($consulta);
        if ($ejecutar->execute() === true) {
            return true;
        }
    }

    function getHost() {
        return $this->host;
    }

    function getUser() {
        return $this->user;
    }

    function getPass() {
        return $this->pass;
    }

}
