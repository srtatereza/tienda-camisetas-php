<?php
session_start();

try {
    $conexion = new PDO("mysql:host=localhost:3306; dbname=camisetas", "root", "");
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar si hay un cliente registrado en la sesión
    if (!isset($_SESSION['id_cliente']) || empty($_SESSION['id_cliente'])) {
        die("Error: No hay cliente registrado.");
    }

    // Obtener información del cliente
    $stmtCliente = $conexion->prepare("SELECT nombre, apellido, direccion, telefono FROM clientes WHERE id_cliente = ?");
    $stmtCliente->execute([$_SESSION['id_cliente']]);
    $cliente = $stmtCliente->fetch(PDO::FETCH_ASSOC);

    

    // Obtener información de los pedidos y productos asociados del cliente
    $stmtPedidos = $conexion->prepare("SELECT p.id_pedido, p.fecha, pr.nombre, p.cantidad_producto as cantidad_producto
    FROM pedidos p 
    JOIN productos pr ON p.codigo = pr.codigo
    WHERE p.id_cliente = ? 
    ORDER BY p.fecha DESC");
$stmtPedidos->execute([$_SESSION['id_cliente']]);


    $pedidos = $stmtPedidos->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    die();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Cliente y Pedidos con Productos</title>
</head>
<body>

    <h2>Información del Cliente</h2>
    <p><strong>Nombre:</strong> <?php echo $cliente['nombre'] . ' ' . $cliente['apellido']; ?></p>
    <p><strong>Dirección:</strong> <?php echo $cliente['direccion']; ?></p>
    <p><strong>Telefono:</strong> <?php echo $cliente['telefono']; ?></p>

    <h2>Pedidos del Cliente con Productos</h2>
    <table border="1">
        <tr>
            <th>ID Pedido</th>
            <th>Fecha del Pedido</th>
            <th>Nombre del Producto</th>  
            <th>Cantida</th>
        </tr>
        <?php foreach ($pedidos as $pedido): ?>
            <tr>
                <td><?php echo $pedido['id_pedido']; ?></td>
                <td><?php echo $pedido['fecha']; ?></td>
                <td><?php echo $pedido['nombre']; ?></td>
                <td><?php echo $pedido['cantidad_producto']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>


      <!-- Enlace para index-->
      <a href="home.php">Seguir Comprando</a>

    <!-- Enlace para cerrar la sesión-->
    <a href="cerrar.php">Cerrar sesión</a>

</body>
</html>