<?php
require_once 'mensajeService.php';
require_once 'conexion.php';
function obtenerMensaje($id_Contacto)
{
    $conexion = conexionBD();

    $sql = "SELECT * FROM mensaje where id_contacto = ? ";
    $queryFormateada = $conexion->prepare($sql);
    $queryFormateada->bind_param('i', $id_Contacto);
    $queryFormateada->execute();
    $resultado = $queryFormateada->get_result();
    $mensajes = [];

    while ($fila = $resultado->fetch_assoc()) {
        $mensajes [] = new mensaje($fila['id'], $fila['texto'], $fila['fecha_Envio']);
    }
    $conexion->close();
    return $mensajes;
}


function guardarMensaje($idContacto, $texto, $fecha_Envio) {
    $conexion = conexionBD();

    // Cambia 'contacto' por 'mensaje' si esa es la tabla correcta
    $sql = "INSERT INTO mensaje (id_Contacto, texto, fecha_envio) VALUES (?, ?, ?)";
    $queryFormateada = $conexion->prepare($sql);

    // Usar 'iss' porque id_Contacto es un entero y texto y fecha son cadenas
    $queryFormateada->bind_param('iss', $idContacto, $texto, $fecha_Envio);
    $ejecutada = $queryFormateada->execute();

    // Cerrar conexión
    $conexion->close();

    return $ejecutada;
}




