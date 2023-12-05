<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CulturalChain</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
            <nav id="navbar">
            <ul id="menu">
                <li><a href="index.php" id="alogo"><img id="logo" src="../img/iconos/logo.jpeg"></a></li>
                <li> <a href="index.php?controller=personajes&action=gestionarPersonajes"><span>PERSONAJES</span><img src="../img/iconos/diseno-de-personaje.png"></a></li>
                <li><a href="index.php?controller=niveles&action=listarNivelesReflexiones"><span>REFLEXIONES</span><img src="../img/iconos/idea.png"></a></li>
                <li><a href="index.php?controller=centros&action=listarCentros"><span>CENTROS</span><img src="../img/iconos/colegio.png"></a></li>
                <li><a href="index.php?controller=niveles&action=listarNiveles"><span>NIVELES</span><img src="../img/iconos/mapa-del-mundo.png"></a></li>
                <li id="barras"><img src="../img/iconos/menu.png"></li>
            </ul>
                 <ul id="submenu">
                        <li><a href="index.php?controller=personajes&action=gestionarPersonajes"><span>PERSONAJES</span><img src="../img/iconos/diseno-de-personaje.png"></a></li>
                        <li><a href="index.php?controller=niveles&action=listarNivelesReflexiones"><span>REFLEXIONES</span><img src="../img/iconos/idea.png"></a></li>
                        <li><a href="index.php?controller=centros&action=listarCentros"><span>CENTROS</span><img src="../img/iconos/colegio.png"></a></li>
                        <li><a href="index.php?controller=niveles&action=listarNiveles"><span>NIVELES</span><img src="../img/iconos/mapa-del-mundo.png"></a></li>       
                    </ul>
        </nav>
<script>
    window.addEventListener('scroll', function() {
    const navbar = document.getElementById('navbar');
    const scrolled = window.scrollY > 40; // Cambiar el valor según la posición del scroll

    if (scrolled) {
        navbar.classList.add('translucent');
    } else {
        navbar.classList.remove('translucent');
    }
});

</script>