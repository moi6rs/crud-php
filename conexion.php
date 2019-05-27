<?php
$host = "localhost";
$puerto = "3306";
$usuario = "root";
$password = "";
$nombreBaseDatos = "registro";
    $conexion = mysqli_connect($host.":".$puerto, $usuario,  $password, $nombreBaseDatos);
?>