<?php

session_start();


$conn = 'mysql:host=localhost:3306;dbname=camisetas';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($conn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Inicializar la sesión si no está configurada
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
        
    }

    // Agregar producto al carrito
    if (isset($_POST['codigo']) && isset($_POST['cantidad'])) {
        $codigo = trim($_POST['codigo']);
        $cantidad = trim($_POST['cantidad']);

        if (isset($_SESSION['carrito'][$codigo])) {
            // Actualizar la cantidad si el producto ya está en el carrito
            $_SESSION['carrito'][$codigo] += $cantidad;
        } else {
            // Agregar el producto al carrito con la cantidad seleccionada
            $_SESSION['carrito'][$codigo] = $cantidad;
        }
    }
    // Mostrar el contenido del carrito
    echo '<h2>Carrito de Compras</h2>';

    $total = 0; // Inicializar el total a cero

    foreach ($_SESSION['carrito'] as $codigo => $cantidad) {
        // Verificar si la cantidad está directamente en el carrito o es un array asociativo
        if (is_array($cantidad)) {
            $producto = $cantidad; // El producto ya tiene formato correcto
        } else {
            // Obtener detalles del producto si la cantidad es directa
            $stmt = $pdo->prepare('SELECT nombre, precio FROM productos WHERE codigo = ?');
            $stmt->execute([$codigo]);
            $producto = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Asegurarse de que la cantidad está presente y es válida
            $producto['cantidad'] = $cantidad;

    
        $precio_total_producto = $producto['precio'] * $cantidad;
        $total += $precio_total_producto;

        echo '<p>' . $producto['nombre'] . ' - Cantidad: ' . $cantidad . ' - Precio: $' . $precio_total_producto . '</p>';

        // Formulario para eliminar producto del carrito
        echo '<form action="carrito.php" method="post">';
        echo '<input type="hidden" name="eliminar_codigo" value="' . $codigo . '">';
        echo '<input type="submit" value="Eliminar">';
        echo '</form>';
    }
}

            echo '<p>Total: $' . $total . '</p>'; 
            echo '<form action="carrito.php" method="post">';
            echo '<input type="submit" name="comprar" value="Comprar">';
            echo '</form>';

            // Enlace para seguir comprando
            echo '<a href="verificar.php">Seguir Comprando</a>';

    // Realizar el pedido al hacer clic en "Comprar"
    if (isset($_POST['comprar'])) {
        // Insertar los productos del carrito en la tabla pedidos
        $fechaCompra = date('Y-m-d H:i:s');
        foreach ($_SESSION['carrito'] as $codigo => $cantidad_producto) {
            $cantidad_producto = is_numeric($cantidad_producto) ? (int)$cantidad_producto : 0;

            $stmtPedido = $pdo->prepare('INSERT INTO pedidos (fecha, id_cliente, codigo, cantidad_producto) VALUES (?, ?, ?, ?)');
            $stmtPedido->execute([$fechaCompra, $_SESSION['id_cliente'], $codigo, $cantidad_producto]);
        }

        // Limpiar el carrito después de realizar la compra
 
        $_SESSION['carrito'] = [];
        echo '<p>Compra realizada con éxito. El carrito ha sido vaciado.</p>';
        echo '<a href="pedidos.php">Ver la factura de mi pedido</a>';
    }
    

} catch (PDOException $e) {
    die('Error al conectarse a la base de datos: ' . $e->getMessage());
}

// Eliminar producto del carrito
if (isset($_POST['eliminar_codigo'])) {
    $eliminar_codigo = $_POST['eliminar_codigo'];
    unset($_SESSION['carrito'][$eliminar_codigo]);
}
?>
