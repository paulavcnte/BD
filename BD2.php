<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BD2
 *
 * @author alumno
 */
class BD2 extends BD {

    private $bbdd;
    private $con;

    public function __construct($host, $user, $pass, $bbdd) {
        parent::__construct("mysql:host=$host; dbname=$bbdd", $user, $pass);
        $this->bbdd = $bbdd;
        $this->con = $this->conectar();
    }

    public function conectar() {
        try {//Solo para cuando nos conectamos**CULPA DE ERICK***
            $conexion = new PDO($this->getHost(), $this->getUser(), $this->getPass());
            echo 'conectado';
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

    public function mostrarDatos(string $consulta) {
        $filas = [];


        $resultado = $this->con->query($consulta);
//        $resultado->execute();
//        while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
//            $filas[] = $fila;
//        }
        while ($registro = $resultado->fetch(PDO::FETCH_OBJ)) {
            var_dump($registro);
        }
//        return $filas;
    }

}
