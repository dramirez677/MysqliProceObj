<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Conexion
 *
 * @author Dani
 */
class Conexion {
    
    private $bd;
    private $usuario;
    private $password;
    
    private $conexion;
    private $result;
    
    function __construct($bd, $usuario, $password) {
        $this->bd = $bd;
        $this->usuario = $usuario;
        $this->password = $password;
        $this->conectar();
    }
    
    
    private function conectar(){
        
        $this->conexion = mysqli_connect("localhost",  $this->usuario,  $this->password, $this->bd);
        echo "Conectado correctamente";
    }
    
    
    
    function datos_tabla($tabla){
        
        if(isset($this->result)){
            
            mysqli_free_result($this->result);
        }
        
        $query = "select * from ".$tabla;
        return $this->result = mysqli_query($this->conexion, $query);
    }
    
    
    function insertar_fila($tabla,$nombre,$apellidos,$edad,$email,$tlf){
        
        
        if(isset($this->result)){
            
            mysqli_free_result($this->result);
        }
        
        
        $query = "insert into ".$tabla." values (?,?,?,?,?)";
        $stmt = mysqli_prepare($this->conexion, $query);

        mysqli_stmt_bind_param($stmt, "ssisi", $val1, $val2, $val3, $val4, $val5);

        $val1 = $nombre;
        $val2 = $apellidos;
        $val3 = $edad;
        $val4 = $email;
        $val5 = $tlf;
        
        return mysqli_stmt_execute($stmt);
        
    }
    
    function borrar_fila($tabla,$email){
        
        if(isset($this->result)){
            
            mysqli_free_result($this->result);
        }
        
        $query = "delete from ".$tabla." where email='".$email."'";
        return $this->result = mysqli_query($this->conexion, $query);
        
    }
    
    function actualizar_fila($tabla,$nombre,$apellidos,$edad,$email,$tlf,$email2){
        
        $query = "update ".$tabla." set nombre='".$nombre."',apellidos='".$apellidos."',edad=".$edad.",email='".$email."',tlf=".$tlf." where email='".$email2."'";
        return $this->result = mysqli_query($this->conexion, $query);
    }
    
    
    
    function obtener_fila(){
        
        return mysqli_fetch_array($this->result);
    }
    
    private function liberar_result(){
        
        return mysqli_free_result($this->result);
    }
    
    function cerrar_sesion(){
        
        if(isset($this->result)){
            
            mysqli_free_result($this->result);
        }
        
        mysqli_close($this->conexion);
        unset($this->conexion);
    }

}
