<?php 
session_start();
include_once 'classes/cliente.php';
include_once 'classes/producto.php';
include_once 'classes/pedido.php';
include_once 'include/camisetasDB.php';

?>

<!DOCTYPE html>
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

<?php


if (isset($_POST['agregar_al_carrito'])) { 
    $id_producto = $_POST['id_producto'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = (int)$_POST['cantidad'];

    // Verifica que la cantidad sea válida (entre 1 y 10)
    if ($cantidad > 0 && $cantidad <= 10) {
        // Agrega el producto al carrito en la sesión
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = array();
        }

        $_SESSION['carrito'][$id_producto] = array(
            'nombre' => $_POST['nombre'],
            'precio' => $_POST['precio'],
            'cantidad' => $cantidad
        );

        echo '<p>Producto agregado al carrito.</p>';
    } else {
        echo '<p>La cantidad seleccionada no es válida.</p>';
    }
}

// Realizar el pedido al hacer clic en "Comprar"
if (isset($_POST['comprar'])) {
    // Insertar los productos del carrito en la tabla pedidos
    $fechaCompra = date('Y-m-d H:i:s');
    foreach ($_SESSION['carrito'] as $id_producto => $producto) {
        $cantidad_producto = $producto['cantidad'];
        $id_cliente = $_SESSION['id_cliente'];
        $pedido = new Pedido("", $fechaCompra, $id_cliente, $id_producto, $cantidad_producto);
        $pedido->insertar();
    }

    // Limpiar el carrito después de realizar la compra
    $_SESSION['carrito'] = [];
    echo '<p>Compra realizada con éxito. El carrito ha sido vaciado.</p>';  

    echo '<a href="pedidos.php">Ver la factura de mi pedido</a>';
    echo '<br>';
}

// Muestra productos en el carrito y calcula el total
if (!empty($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $id_producto => $producto) {
        echo '<p class="titulo_c">Nombre:' . $producto['nombre'] . '</p>';
        echo '<p class="titulo_c">Precio: ' . $producto['precio'] . '$.c/u</p>';

        // Otros detalles del producto...

        $precio_total_producto = $producto['precio'] * $producto['cantidad'];
        $total += $precio_total_producto;

        echo '<p class="titulo_c">' .'Cantidad: ' . $producto['cantidad'] . ' = Precio: $' . $precio_total_producto . '</p>';
        echo '<br>';
        // Puedes realizar operaciones adicionales aquí, como la suma del total
    }

    echo '<p class="titulo_c">Precio Total: $' . $total . '</p>';
    echo '<br>';

    // Agregar un enlace o formulario para eliminar productos del carrito
echo '<form action="carrito.php" method="post">';
echo '<input type="hidden" name="eliminar_producto" value="' . $id_producto . '">';
echo '<input type="submit" name="eliminar" value="Eliminar" class="formulario_submit">';
echo '</form>';

echo '<br>';


//formulario para comprar los productos
echo '<form action="carrito.php" method="post">';
echo '<input type="submit" name="comprar" value="comprar" class="formulario_submit">';
echo '</form>';
} 



// Procesar eliminación del carrito
if (isset($_POST['eliminar_producto'])) {
    $id_productoEliminar = $_POST['eliminar_producto'];
    unset($_SESSION['carrito'][$id_productoEliminar]);
    echo 'Producto eliminado del carrito.';
}

echo '<br>';
echo '<a href="home.php">Seguir Comprando</a>';

?>
</div>

</div>
</body>
</html>
