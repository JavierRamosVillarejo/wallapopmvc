<?php

class Conexion {

    public static function conectar():mysqli {
        $conn = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASS,MYSQL_BD);
        if($conn->connect_error){
            die("Error al conectar con mysql: " . $conn->connect_error);
        }
        return $conn;
    }

}
