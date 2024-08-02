<?php

if(!isset($_SESSION)) {
    session_start();
}
$auth = $_SESSION['login'] ?? false;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>

    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="logotipo de bienes y raices" class="logo">
                </a>
                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu reponsive">
                </div>  
                <div class="derecha">
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="dark-mode">
                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contactos</a>
                        <a href="login.php">iniciar sesion</a>
                        <?php if($auth):  ?>  
                        <a href="cerrar-sesion.php">cerrar Sesion</a> 
        
                        <?php endif; ?>  
                    </nav>

                </div>   
            </div><!--final de la barra-->
        <?php if($inicio) { ?> <h1>Ventas de Casas y Departamentos Eclusivos de Lujos</h1>
        <?php } ?>  
        </div>

    </header>