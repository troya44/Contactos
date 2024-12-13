<?php
function conexionBD()
{
    $host = 'localhost';
    $puerto = 3307;
    $basededatos = 'contactos';
    $usuario = 'root';
    $password = '';

    $conexion = new mysqli($host, $usuario, $password, $basededatos, $puerto);

    if ($conexion->connect_error) {
        die('Error de conexión: ' . $conexion->connect_error);
    }
    return $conexion;
}
