<?php
session_start();
include_once 'include/camisetasDB.php';
include_once 'classes/cliente.php';

// Verifica si se envió el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logarse"])) {
    $email = trim($_POST["email"]);
    $contrasenia = trim($_POST["contrasenia"]);

    //error de php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');  

    // Crear una instancia de Cliente y realizar la consulta
    $cliente = new Cliente($email,$contrasenia,"","","","","");
    $clienteEncontrado = $cliente->select($email);

    // Verifica si se encontró el correo y si la contraseña coincide con la registrada.
    if ($clienteEncontrado && password_verify($contrasenia, $clienteEncontrado['contrasenia'])) {
        $_SESSION['email'] = $email;
        $_SESSION['id_cliente'] = $clienteEncontrado['id_cliente'];
        header("Location: home.php");
        exit();
        
    } else {
        $mensajeError = "email o contraseña incorrectos.";
    }
}

//Mensaje con un enlace a la pagina de registro
$mensajeInicio = "No estas registrado<br><a href='registro.php'>Ir a Registrarse</a>";

?>


<!DOCTYPE html>
<html lang="es">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda_Camisetas</title>
    <!-- Enlace al archivo CSS externo -->
    <link rel="stylesheet" href="css/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>

<body>
    <div class="contenedor">

   

    <?php
    // Mostrar un mensaje de Inicio o un Mensaje en caso de Error.
    if (isset($mensajeError)) {
        echo "<p>$mensajeError</p>";
    }
    if (isset($mensajeInicio)) {
        echo "<p>$mensajeInicio</p>";
    }
    ?>
    <h2>Iniciar sesión</h2>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="formulario">
        <label for="email">email:</label>
        <input type="email" name="email" id="email" placeholder="Correo electrónico"  required autocomplete="username">
        <br>

        <label for="contrasenia">contraseña:</label>
        <input type="password" name="contrasenia" id="contrasenia" placeholder="contraseña" required autocomplete="current-password">
        
        <br>
        <input type="submit" name="logarse" value="Iniciar sesión" class="formulario_submit">
    </form>

    </div>

</body>

</html>
