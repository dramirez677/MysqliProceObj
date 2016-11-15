<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require 'Clases/Conexion.php';

        //conexion a la base de datos
//        $conexion = new Conexion("personas","dani","dani");
//        
//        
//        //obtengo los datos de la tabla usuario
//        if($conexion->datos_tabla("usuario")){
//            
//            echo "Consulta realiza con exito"."<br><br>";
//            
//            $fila = $conexion->obtener_fila();
//            
//            for($i=0;$i<count($fila);$i++){
//            
//                echo $fila[$i]."<br>";
//            }
//        }
//        
//        
//        
//        //inserto un usuario en la base de datos
//        if($conexion->insertar_fila("usuario","prueba", "apellidos", 24, "dani_dj09@hotmail.com", 123456789)){
//            
//            echo "Insert realizado con exito"."<br><br>";
//        }
//        if($conexion->borrar_fila("usuario", "dani_dj09@hotmail.com")){
//            
//            echo "Delete realizado con exito"."<br><br>";
//        }
//        
//        if($conexion->actualizar_fila("usuario", "prueba2", "apellidos", 24, "dani_dj09@hotmail.com", 123456789, "dramirez677@gmail.com")){
//            
//            echo "Update realizado con exito"."<br><br>";
//        }
//        $conexion->cerrar_sesion();


        $conexion = new mysqli("localhost", "dani", "dani", "personas");
        echo "Conexion realizada con exito" . "<br><br>";

        $consulta = "select * from usuario";
        $delete = "delete from usuario where email='dani_dj09@hotmail.com'";
        $update = "update usuario set nombre='prueba' where email='dani_dj09@hotmail.com'";
        $insert = "insert into usuario values('daniel','ramirez ros',24,'dramirez677@gmail.com',123456789)";
        $result = $conexion->query($consulta);

        
        //consultar y mostrar datos
        if (!$result) {

            echo "result vacio" . "<br>";
        } 
        else {
            
            while ($row = $result->fetch_assoc()) {

                echo "Nombre[".$row['nombre']."] Apellidos[".$row['apellidos']."] Edad[".$row['edad']."] Email[".$row['email']."] Telefono[".$row['tlf']."]"."<br>";
            }
        }
        
        
        //borrar un registro
        $result = $conexion->query($delete);
        if($result){
            
            echo "Registro borrado con exito";
        }
        else{
            
            echo "Registro no borrado con exito";
        }
        
        
        
        //actualizar un registro
        $result = $conexion->query($update);
        if($result){
            
            echo "Registro actualizado con exito";
        }
        else{
            
            echo "Registro no actualizado con exito";
        }
        
        
        
        //insertar un registro
        $result = $conexion->query($insert);
        if($result){
            
            echo "Registro insertado con exito";
        }
        else{
            
            echo "Registro no insertado con exito";
        }

        $conexion->close();
        ?>
    </body>
</html>
