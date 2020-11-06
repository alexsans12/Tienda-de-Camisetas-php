<?php
class Database
{
    public static function conectar(){
        $conexion = new mysqli(
            'localhost',
            'root',
            'root',
            'tienda_master'
        );

        $conexion->query("SET NAMES 'UTF8'");
        return $conexion;
    }
}