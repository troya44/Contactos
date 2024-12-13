<?php

require_once 'contacto.php';
require_once 'conexion.php';
function obtenerContacto($id_Usuario)
{
    $conexion = conexionBD();

    $sql = "SELECT * FROM contacto where id_Usuario = ?";
    $queryFormateada = $conexion->prepare($sql);
    $queryFormateada->bind_param('i', $id_Usuario);
    $queryFormateada->execute();
    $resultado = $queryFormateada->get_result();
    $contactos = [];

    while ($fila = $resultado->fetch_assoc()) {
        $contactos [] = new contacto($fila['id'], $fila['nombre'],$fila['apellidos'],$fila['telefono'], $fila['foto']);
    }
    $conexion->close();
    return $contactos;
}


function guardarContacto($id_Usuario, $nombre, $apellidos, $telefono, $foto){
    $conexion = conexionBD();
    $sql = "INSERT INTO contacto (id_Usuario,nombre, apellidos, telefono, foto) VALUES (?,?,?,?,?)";
    $queryFormateada = $conexion->prepare($sql);
    //Con bind_param introducimos en la base de datos la linea que queremos
    //hay que decirle que va a ser un string con el 's',y luego la variable que vamos a usar
    $queryFormateada->bind_param('issis', $id_Usuario, $nombre, $apellidos, $telefono, $foto);
    $ejecutada = $queryFormateada->execute();
    $conexion->close();
    return $ejecutada;
}

function actualizarContacto($id, $nombre)
{
    $conexion = conexionBD();
    $sql = "UPDATE contacto SET nombre = ? WHERE id = ?";
    $queryFormateada = $conexion->prepare($sql);
    $queryFormateada->bind_param('si', $nombre, $id);
    $ejecutada = $queryFormateada->execute();
    $conexion->close();
    return $ejecutada;
}

function obtenerContactoId($id)
{
    $conexion = conexionBD();

    $sql = "SELECT * FROM contacto where id = ?";
    $queryFormateada = $conexion->prepare($sql);
    $queryFormateada->bind_param('i', $id);
    $queryFormateada->execute();
    $resultado = $queryFormateada->get_result();
    $contactos = [];

    while ($fila = $resultado->fetch_assoc()) {
        $contactos [] = new contacto($fila['id'], $fila['nombre'],$fila['apellidos'],$fila['telefono'], $fila['foto']);
    }
    $conexion->close();
    return $contactos;
}