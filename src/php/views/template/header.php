<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CulturalChain</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <?php $_SESSION['perfil'] == 's' ? $display = 'flex': $display = 'none'?>
            <nav id="navbar">
            <ul id="menu">
                <li><a href="index.php?controller=login&action=mostrarAdmin" id="alogo"><img id="logo" src="../img/iconos/logo.jpeg"></a></li>
                <li> <a href="index.php?controller=personajes&action=gestionarPersonajes"><span>PERSONAJES</span><img src="../img/iconos/diseno-de-personaje.png"></a></li>
                <li><a href="index.php?controller=niveles&action=listarNivelesReflexiones"><span>REFLEXIONES</span><img src="../img/iconos/idea.png"></a></li>
                <li><a href="index.php?controller=centros&action=listarCentros"><span>CENTROS</span><img src="../img/iconos/colegio.png"></a></li>
                <li><a href="index.php?controller=niveles&action=listarNiveles"><span>NIVELES</span><img src="../img/iconos/mapa-del-mundo.png"></a></li>
                <li id="barras"><img src="../img/iconos/menu.png"></li>
                <li style="display:<?php echo $display; ?>"><a href="index.php?controller=login&action=registrarAdmin"><img id="logo" style="border-radius:0;box-shadow:none;" src="../img/iconos/admin.svg"></a></li>
            </ul>
                 <ul id="submenu">
                        <li><a href="index.php?controller=personajes&action=gestionarPersonajes"><span>PERSONAJES</span><img src="../img/iconos/diseno-de-personaje.png"></a></li>
                        <li><a href="index.php?controller=niveles&action=listarNivelesReflexiones"><span>REFLEXIONES</span><img src="../img/iconos/idea.png"></a></li>
                        <li><a href="index.php?controller=centros&action=listarCentros"><span>CENTROS</span><img src="../img/iconos/colegio.png"></a></li>
                        <li><a href="index.php?controller=niveles&action=listarNiveles"><span>NIVELES</span><img src="../img/iconos/mapa-del-mundo.png"></a></li>       
                    </ul>
        </nav>
<script type="module" src="../js/views/scrollnav.js"></script>