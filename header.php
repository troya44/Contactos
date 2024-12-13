<?php
require_once('usuario.php');
session_start();
?>
<header>
    <h1><?= $titulo = ''; ?></h1>
        <img class="imagen" src="<?= $_SESSION['sesion']->getAvatar(); ?>">
</header>