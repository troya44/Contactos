<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar Sesión</title>
    <link href="styles.css" rel="stylesheet">

</head>
<body>
<form method="post" action="?">
    <label for="telefono">Introduzca el número de telefono</label>
    <input type="tel" name="telefono"><br>
    <label for="password">Introduzca la contraseña</label>
    <input type="password" name="password"><br>
    <input type="submit" value="Iniciar Sesión">

</form>
</body>
</html>


<?php
require_once 'usuarioService.php';
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
$telefono = $_POST['telefono'];
$password = $_POST['password'];
if(isset($telefono) && isset($password)){
        $usuarioLogin = login($telefono, $password);
        if($usuarioLogin){
            $_SESSION['sesion'] = $usuarioLogin;
            header("Location: index.php");
        } else {
            header("Location: inicio.php");
        }
    }
}

