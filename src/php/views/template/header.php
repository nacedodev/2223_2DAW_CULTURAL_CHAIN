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
            <ul>
                <li><a href="index.php"><img id="logo" src="../img/iconos/logo.jpeg"></a></li>
                <li> <a href="index.php?controller=personajes&action=gestionarPersonajes">PERSONAJES</a></li>
                <li><a href="index.php?controller=niveles&action=listarNivelesReflexiones">REFLEXIONES</a></li>
                <li><a href="index.php?controller=centros&action=listarCentros">CENTROS</a></li>
                <li><a href="index.php?controller=niveles&action=listarNiveles">NIVELES</a></li>
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