<?php
require_once 'usuario.php';
require_once 'contacto.php';
require_once 'contactoService.php';
require_once 'mensajeService.php';
require_once 'mensaje.php';

session_start();

// Verificar y reinicializar la sesión si es necesario
if (!isset($_SESSION['sesion']) || !is_object($_SESSION['sesion']) || !method_exists($_SESSION['sesion'], 'getId')) {
    $_SESSION['sesion'] = new Usuario(); // Asegúrate de que la clase Usuario esté definida correctamente
}

// Obtener los contactos
$contactos = obtenerContacto($_SESSION['sesion']->getId());

// Verificar si hay contactos
if (empty($contactos)) {
    die("No se encontraron contactos.");
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="styles.css" rel="stylesheet">
    <title>Detalle Contactos</title>
    <style>
        /* Reset básico */
        body, h1, h2, p {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        /* Estilo del cuerpo */
        body {
            background-color: #f4f4f4; /* Color de fondo suave */
            color: #333; /* Color de texto */
            line-height: 1.6; /* Espaciado entre líneas */
        }

        /* Título principal */
        h1 {
            text-align: center;
            margin: 20px 0;
            color: #007BFF; /* Color azul para el título */
        }

        /* Contenedor de contacto */
        .contacto-info {
            background-color: #ffffff; /* Fondo blanco para los contactos */
            border-radius: 8px; /* Bordes redondeados */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
            margin: 20px auto; /* Margen automático para centrar */
            padding: 20px; /* Espaciado interno */
            max-width: 600px; /* Ancho máximo del contenedor */
        }

        /* Imagen del contacto */
        .imagen {
            max-width: 100%; /* Imagen responsiva */
            height: auto;
            border-radius: 50%; /* Imagen circular */
        }

        /* Estilo de los encabezados dentro del contacto */
        h2 {
            color: #333; /* Color de texto para los encabezados */
        }

        /* Estilo del formulario */
        form {
            margin-top: 10px; /* Espaciado superior en el formulario */
        }

        /* Estilo del área de texto */
        textarea {
            width: 100%; /* Ancho completo del área de texto */
            padding: 10px; /* Espaciado interno */
            border-radius: 5px; /* Bordes redondeados */
            border: 1px solid #ccc; /* Borde gris claro */
            resize: none; /* Deshabilitar redimensionamiento manual */
        }

        /* Estilo del botón de envío */
        button {
            background-color: #007BFF; /* Color azul para el botón */
            color: white; /* Texto blanco en el botón */
            border: none; /* Sin borde en el botón */
            padding: 10px 15px; /* Espaciado interno del botón */
            border-radius: 5px; /* Bordes redondeados en el botón */
            cursor: pointer; /* Cambiar cursor al pasar sobre el botón */
        }

        button:hover {
            background-color: #0056b3; /* Color más oscuro al pasar el ratón sobre el botón */
        }

        /* Estilo para los mensajes enviados */
        ul {
            list-style-type: none; /* Sin viñetas en la lista de mensajes */
        }

        li {
            background-color: #e9ecef; /* Fondo gris claro para los mensajes */
            border-radius: 5px; /* Bordes redondeados en los mensajes */
            padding: 10px; /* Espaciado interno en los mensajes */
            margin-top: 5px; /* Margen superior entre mensajes */
        }

    </style>
    <?php
    include 'header';
    $titulo  = 'Detalle de contacto';
    ?>
</head>
<body>

<h1>Lista de Contactos</h1>

<?php foreach ($contactos as $contacto): ?>
    <div class="contacto-info">
        <img class="imagen" src="<?= $contacto->getFoto() ?>" alt="Foto de <?= $contacto->getNombre() ?>">
        <h2>Nombre: <?= $contacto->getNombre() ?></h2>
        <h2>Apellidos: <?= $contacto->getApellidos() ?></h2>
        <p>Teléfono: <?= $contacto->getTelefono() ?></p>

        <form action="" method="post">
            <input type="hidden" value="<?= $contacto->getId() ?>" name="id">
            <label for="texto<?= $contacto->getId() ?>">Mensaje:</label>
            <textarea id="texto<?= $contacto->getId() ?>" name="texto" required></textarea>

            <button type="submit">Enviar</button>
        </form>
    </div>
<?php endforeach; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $texto = $_POST['texto'];
    $id = intval($_POST['id']); // Convertir a entero para evitar inyecciones SQL
    $fecha_Envio = date('Y-m-d H:i:s'); // Obtener la fecha y hora actual

    $guardarMensaje = guardarMensaje($id, $texto, $fecha_Envio);

    if ($guardarMensaje) {
        echo "<p>Mensaje enviado correctamente.</p>";

    } else {
        echo "<p>Error al enviar el mensaje.</p>";
    }
    $mensajes = obtenerMensaje($contacto->getId());
    if (!empty($mensajes)) {
        foreach ($mensajes as $mensaje) {
            echo "<ul>";
            echo "<li><p>" . $mensaje->getTexto() . "</p></li>";
            echo "</ul>";
        }
    } else {
        echo "<p>No hay mensajes disponibles.</p>";
    }

}


?>
<a href="index.php">Volver al incio</a>
</body>
</html>
