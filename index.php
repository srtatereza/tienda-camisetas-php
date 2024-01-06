<?php
session_start();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda_Camisetas</title>
    <!-- Enlace al archivo CSS externo -->
    <link rel="stylesheet" href="css/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>

<body>
    <div class="contenedor"> 

        <h2>Bienvenido a Mi Tienda</h2>


        <!-- CONTENEDOR DEL CARRUSEL, esta echo con una libreria de Bootstrap  cuenta con 3 imagenes-->
		<div class="bloque-img">
        <!-- Imágenes del banner -->
            <img class="blo-img" src="img/imagen1.jpg" alt="Imagen 1">
            <img class="blo-img" src="img/imagen4.jpg" alt="Imagen 2">
            <img class="blo-img" src="img/imagen3.jpg" alt="Imagen 3">
            <img class="blo-img" src="img/imagen6.jpg" alt="Imagen 3">
            <img class="blo-img" src="img/imagen9.jpg" alt="Imagen 3">
            <img class="blo-img" src="img/imagen5.jpg" alt="Imagen 3">
        </div>

        <h3>Deseas ver Mi coleccion de Productos</h3> 


    <!-- enlaces hacia la pagina de registro o de login -->

        <div class="enlaces-sesion">  
        <a href="login.php" class="button">Iniciar Sesión</a>
        <a href="registro.php" class="button">Registrate </a>
        </div> 
    </div>

  

</body>

</html>