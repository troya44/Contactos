<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <title>Editar tarea</title>
</head>
<body>
<header>
    <?php
    $tituloDePagina = "Editar tarea";
    ?>


</header>
<main>
<form action="#" method="post">
    <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?php echo $_GET['nombre']?>">
    <input type="submit" value="Guardar" class="button">
</form>
    <?php
    require_once 'contactoService.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['nombre'])!='') {
        $nombre = $_POST['nombre'];
        $id = $_POST['id'];
        $modificarContacto = actualizarContacto($id, $nombre);
        if ($modificarContacto) {
            header('Location: index.php');
        } else {
            echo 'Algo ha ido mal';
        }
    }
    ?>
</main>
<footer></footer>
</body>
</html>
