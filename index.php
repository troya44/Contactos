<?php
require_once ('usuario.php');
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <title>Lista de contactos</title>
</head>
<body>
<?php
$titulo = "Lista de contactos";
include ("header.php");
?>
<main>
    <?php
    require_once 'contactoService.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
    }

    $contactos = obtenerContacto($_SESSION['sesion']->getId());
    ?>
    <h2>Lista de contactos</h2>
    <ul>
        <?php foreach ($contactos as $contacto): ?>
            <?php $funcionOnclick = "document.getElementById('contacto-".$contacto->getId()."').showModal()";?>
            <li id="<?= $contacto->getId() ?>">
                <p><b><a href="detalleContacto.php"><?= $contacto->getNombre()?></a></b></p>
                <a href="editarContacto.php?id=<?= $contacto->getId() ?>&nombre=<?= $contacto->getNombre() ?>" class="button">
                    ✏️ Editar
                </a>
                <button onclick="<?=$funcionOnclick?>"> 🗑️ Eliminar</button>
                <dialog id="contacto-<?= $contacto->getId() ?>">
                    <form action="?" method="post">
                        <input type="hidden" value="<?= $contacto->getId() ?>" name="id">
                        <p>¿Está seguro de eliminar este contacto?</p>
                        <input type="submit" class="button" value="Eliminar">
                    </form>
                </dialog>
            </li>
        <?php endforeach;?>
    </ul>
    <section class="botones">
        <a href="crearContacto.php">Crear nuevo contacto</a>
    </section>
</main>
<a href="inicio.php">Cerrar sesion</a>
<footer></footer>
</body>
</html>
