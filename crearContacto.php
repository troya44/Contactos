<?php
// Implementar el autoloader, que se encarga de incluir automáticamente los archivos de clase cuando se necesitan
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});
require_once 'usuario.php';
require_once 'contactoService.php';
require_once 'contacto.php';

session_start();

$tituloDePagina = "Nuevo Contacto";

if (!isset($_SESSION['sesion'])
    && basename($_SERVER['PHP_SELF']) !='login.php' && basename($_SERVER['PHP_SELF']) !='registro.php')
{
    header("Location: login.php");
    exit;
}

// Asegurarse de que $_SESSION['sesion'] es un objeto con el método getId()
if (!is_object($_SESSION['sesion']) || !method_exists($_SESSION['sesion'], 'getId')) {
    die("Error: Sesión inválida");
}

$idUsuario = $_SESSION['sesion']->getId();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    <title>Crear Contacto</title>
</head>
<body>
<main>
    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre del contacto:</label>
        <input type="text" name="nombre" id="nombre" required>

        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" id="apellidos" required>

        <label for="telefono">Teléfono:</label>
        <input type="tel" name="telefono" id="telefono" required>

        <label for="foto">Foto:</label>
        <input type="file" name="foto" accept="image/*" id="foto">

        <input type="hidden" name="id" id="id" value="<?php echo $idUsuario; ?>">
        <input type="submit" value="Guardar" class="button">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $id = $_POST['id'];
        $apellidos = $_POST['apellidos'];
        $telefono = $_POST['telefono'];

        //para poder meter la foto
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $foto = $_FILES['foto']['name'];
            $rutaArchivo = 'uploads/' . $foto;
            move_uploaded_file($_FILES['foto']['tmp_name'], $rutaArchivo);
        } else {
            $foto = '';
        }

        try {
            $guardarContacto = guardarContacto($id, $nombre, $apellidos, $telefono, $foto);
            if ($guardarContacto) {
                header('Location: index.php');
                exit;
            } else {
                $error = 'No se pudo guardar el contacto';
            }
        } catch (Exception $e) {
            $error = 'Error: ' . $e->getMessage();
        }
    }
    ?>
</main>
<footer></footer>
</body>
</html>
