<?php

require_once "usuario.php";
require_once 'conexion.php';

function login($telefono, $password)
{
    $conexion = conexionBD();
    $sql = "SELECT * FROM usuario WHERE telefono= ? AND password= ?";
    $queryFormateada = $conexion->prepare($sql);
    $queryFormateada->bind_param('is', $telefono, $password);
    $queryFormateada->execute();
    $resultadoLogin = $queryFormateada->get_result();

    if ($resultadoLogin->num_rows == 1) {
        $usuarioBD = $resultadoLogin->fetch_assoc();
        $usuario = new Usuario (
            $usuarioBD["id"],
            $usuarioBD["nombre"],
            $usuarioBD["password"],
            $usuarioBD["avatar"]);
        $conexion->close();
        return $usuario;
    }
    return false;
    $conexion->close();
}

function registrarUsuario($telefono, $password, $avatar){
    $nombreArchivo = $avatar["name"];
    $avatarTmp = $avatar["tmp_name"];
    $rutaCarpeta = "img/usuario_$telefono";
    if (!file_exists($rutaCarpeta)) {
        mkdir($rutaCarpeta, 0777, true);
    }
    $rutaArchivo = "$rutaCarpeta/$nombreArchivo";
    move_uploaded_file($avatarTmp, $rutaArchivo);

    $conexion = conexionBD();
    $sql1 = "SELECT * FROM usuario WHERE telefono= ?";
    $queryFormateada1 = $conexion->prepare($sql1);
    $queryFormateada1->bind_param('i', $telefono);
    $queryFormateada1->execute();
    $resultadoUsuario = $queryFormateada1->get_result();

    if ($resultadoUsuario->num_rows == 1) {
        echo "<p>El usuario existe.</p>";
    } else {
        $sql2 = "INSERT INTO usuario (telefono, password, avatar) VALUES (?, ?, ?)";
        $queryFormateada = $conexion->prepare($sql2);
        $queryFormateada->bind_param('sss', $telefono, $password, $rutaArchivo);
        $ejecutada = $queryFormateada->execute();
        $conexion->close();
        return $ejecutada;
    }


}

