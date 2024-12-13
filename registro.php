<!doctype html>
<html lang="en">
<?php
require_once 'usuarioService.php';
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $telefono = $_POST["telefono"];
    $password = $_POST["password"];
    $avatar = $_FILES["avatar"];
    $nombreArchivo = $avatar["name"];
    $avatarTmp = $avatar["tmp_name"];
    $rutaArchivo = $nombreArchivo;
    if (isset($telefono) && isset($password) && isset($avatar)) {
        if (registrarUsuario($telefono, $password, $avatar)) {
            header("location: login.php");
        } else {
            header("location: inicio.php");
        }
    }
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro de nuevos usuario</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php
$titulo = "Registrar Usuario";
echo $titulo;

?>
<main>
        <section class="login">
            <div class="tituloLogin">
                <h2>Registro</h2>
            </div>
            <div class="formLogin">
                <form id="login" action="?" method="post" enctype="multipart/form-data">
                    <label for="telefono">Telefono:</label>
                    <input type="tel" placeholder="telefono" name="telefono" required><br>

                    <label for="password">Contraseña:</label>
                    <input type="password" placeholder="contraseña" name="password" required><br>

                    <label for="avatar">Avatar</label>
                    <input type="file" name="avatar" accept="image/*" id="avatar" required><br>

                    <input type="submit" name="login" id="login" class="button" value="Resgistrarse">

                </form>
            </div>
        </section>
</main>
<footer></footer>
</body>
</html>
