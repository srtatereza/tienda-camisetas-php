<?php
session_start();

// Verifica si el usuario está autenticado
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

// Inicializa la variable $_SESSION['id_cliente']
$_SESSION['id_cliente'] = null;

$conn = 'mysql:host=localhost:3306;dbname=camisetas';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($conn, $username, $password);

    $stmt = $pdo->prepare('SELECT id_cliente, email FROM clientes WHERE email = ?');
    $stmt->execute([$_SESSION['email']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Asigna $_SESSION['id_cliente'] si se encontró el usuario
        $_SESSION['id_cliente'] = $row['id_cliente'];
    }
} catch (PDOException $e) {
    die('Error al conectarse a la base de datos: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Feedback-TerezaFranco</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../lib/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="../../lib/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

    <h1>SESION INICIADA CORRECTAMENTE - ( Estas dentro del sistema).</h1>
    <!-- Mensaje al usuario, mostrando su correo de login -->
    <h2>Tu correo es: <?php echo $_SESSION['email']; ?></h2>

    <!-- CONTENEDOR DE LOS PRODUCTOS -->
    <h1 class="bienvenido">Productos</h1>

<?php


$conn = new PDO('mysql:host=localhost:3306;dbname=camisetas', 'root', ''); // Asegúrate de tener los valores correctos

try {
    $stmt = $conn->query('SELECT * FROM productos');
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($productos as $producto) {
        echo '<h2>' . $producto['nombre'] . '</h2>';
        echo '<p>Código: ' . $producto['codigo'] . '</p>';
        echo '<p>Precio: $' . $producto['precio'] . '</p>';
        echo '<img src="' . $producto['imagen'] . '" alt="' . $producto['nombre'] . '">';


        // Formulario para agregar al carrito con cantidad
        echo '<form action="carrito.php" method="post">';
        echo '<input type="hidden" name="codigo" value="' . intval($producto['codigo'] ). '">';

        // Campo para la cantidad
        echo '<label for="cantidad">Cantidad:</label>';
        echo '<input type="number" name="cantidad" min="1" max="10" value="1">';

        // Botón para agregar al carrito
        echo '<input type="submit" value="Agregar al Carrito">';
        echo '</form>';
    }
} catch (PDOException $e) {
    die('Error al conectarse a la base de datos: ' . $e->getMessage());
}
?> 



    <!-- Enlace para cerrar la sesión-->
    <a href="cerrar.php">Cerrar sesión</a>

</body>
</html>