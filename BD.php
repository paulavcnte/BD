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
    private $info;
    private $host;
    private $user;
    private $pass;
    private $bd;

    public function __construct($host, $user, $pass) {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
    }

    /**
     *
     * @param string $c
     * @return array
     */
//    public function select(string $c): array {
//        $filas = [];
//        if ($this->con == null) {
//            $this->con = $this->conexion();
//        }
//        $resultado = $this->con->query($c);
//        while ($fila = $resultado->fetch_row()) {//mientras fila sea distinto de null cogemos el siguiente valor
//            $filas[] = $fila;
////            var_dump($fila);
//        }
//        return $filas;
//    }
//    public function actualizar(string $c): bool {
//
//        if ($this->con == null) {
//            $this->con = $this->conexion();
//        }
//        $resultado = $this->con->query($c);
//
//        if ($resultado === true) {
//            echo "fila actualizada correctamente";
//            return true;
//        } else {
//            echo " " . $this->con->geterrormessage;
//            return false;
//        }
//    }
//
//    public function selectproductoCod($c) {
//
//
//        $resultado = $this->con->query($c);
//        while ($fila = $resultado->fetch_array()) {
//            return $fila;
//        }
//    }

    /**
     *
     * @param string $table_name es el nombre de la tabla cutos nombre de campos quiera
     * @return array indexado con los nombres de los campos
     */
//    public function nombres_campos(string $tabla_name): array {
//        $campos = [];
//
//        $consulta = "select * from $tabla_name";
//        $r = $this->con->query($consulta);
//        $campos_obj = $r->fetch_fields(); //me devuelve un array de objetos
//        foreach ($campos_obj as $campo) {
//            $campos[] = $campo->name;
//        }
//        return $campos;
// //   }

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

//    public function cerrar() {//cerramos la conexion con la bbdd
//        $this->con->close();
//    }
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
