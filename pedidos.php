<?php
session_start();

include_once 'classes/producto.php';
include_once 'classes/cliente.php';
include_once 'classes/pedido.php';
include_once 'include/camisetasDB.php';

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar_pedido'])) {
        // Asegúrate de validar y sanear la entrada del usuario
        $id_cliente = $_SESSION['id_cliente'];
        $idPedidoEliminar = $_POST['id_pedido'];
        $pedidos = Pedido::deletePedido($idPedidoEliminar, $id_cliente);
    }
} catch (PDOException $e) {
    die('Error al conectarse a la base de datos: ' . $e->getMessage());
}

try {
    // Obtener la lista de pedido utilizando la función select de la clase Pedido
    $id_cliente = $_SESSION['id_cliente'];
    $pedidos = Pedido::select_pedido($id_cliente);
} catch (PDOException $e) {
    die('Error al conectarse a la base de datos: ' . $e->getMessage());
}

error_reporting(E_ALL)
?>

<!DOCTYPE html>
<html lang="es">

<html>

    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda_Camisetas</title>
    <!-- Enlace al archivo CSS externo -->
    <link rel="stylesheet" href="css/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
<body>

<div class="menu">
			<ul class="menu-content">
				<li><a href="home.php">Home</a></li>
                <li><a href="carrito.php">Carrito</a></li>
				<li><a href="pedidos.php">Pedidos</a></li>
			</ul>
</div>

<div class="contenedor">

<div class="carrito-producto"> 
    <h2>Pedidos del Cliente</h2>
    <table border="1">
        <tr>
            <th>ID Pedido</th>
            <th>Fecha del Pedido</th>
            <th>Nombre del Producto</th>
            <th>Cantida</th>
            <th>Historial</th>
        </tr>
        <?php foreach ($pedidos as $pedido): ?>
            <tr>
                <td><?php echo $pedido['id_pedido']; ?></td>
                <td><?php echo $pedido['fecha']; ?></td>
                <td><?php echo $pedido['nombre']; ?></td>
                <td><?php echo $pedido['cantidad_producto']; ?></td>
                <td>
                    <!-- Formulario para eliminar el pedido específico -->
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input type="hidden" name="id_pedido" value="<?php echo $pedido['id_pedido']; ?>">
                        <input type="submit" name="eliminar_pedido" value="Eliminar" class="formulario_submit">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

    <br>
    <!-- Enlace para index-->
    <a href="home.php">Seguir Comprando</a>
    <br>
    <br>

    <!-- Enlace para cerrar la sesión-->
    <a href="cerrar.php">Cerrar sesión</a>

    </div>

</body>

</html>