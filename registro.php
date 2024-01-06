<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["registrarse"])) {
    $nombre = trim($_POST["nombre"]);
    $apellido = trim($_POST["apellido"]);
    $direccion = trim($_POST["direccion"]);
    $telefono = trim($_POST["telefono"]);
    $email = trim($_POST["email"]);
    $contraseniaRegistro = trim($_POST["contrasenia_registro"]);
    $contraseniaConfirmacion = trim($_POST["confirmar_contrasenia"]);

    if ($contraseniaRegistro !== $contraseniaConfirmacion) {
        $mensajeErrorRegistro = "Las contraseñas no coinciden. Por favor, inténtalo de nuevo.";
    } else {
        $almacenarPassword = password_hash($contraseniaRegistro, PASSWORD_BCRYPT);

        try {
            $conexion = new PDO("mysql:host=localhost:3306; dbname=camisetas", "root", "");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if (!$conexion) {
                die("Error de conexión a la base de datos");
            }

            $UsuarioExistente = $conexion->prepare("SELECT * FROM camisetas.clientes WHERE email = :email");
            $UsuarioExistente->bindParam(":email", $email);
            $UsuarioExistente->execute();

            if ($UsuarioExistente->rowCount() > 0) {
                $mensajeErrorRegistro = "El correo del usuario ya está en uso.";
            } else {
                $InsertarUsuario = $conexion->prepare("INSERT INTO camisetas.clientes (nombre, apellido, direccion, telefono, email, contrasenia) VALUES (:nombre, :apellido, :direccion, :telefono, :email, :contrasenia)");
                $InsertarUsuario->bindParam(":nombre", $nombre);
                $InsertarUsuario->bindParam(":apellido", $apellido);
                $InsertarUsuario->bindParam(":direccion", $direccion);
                $InsertarUsuario->bindParam(":telefono", $telefono);
                $InsertarUsuario->bindParam(":email", $email);
                $InsertarUsuario->bindParam(":contrasenia", $almacenarPassword);
                $InsertarUsuario->execute();

                $mensajeExitoRegistro = "Usuario registrado con éxito.";
            }
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        } finally {
            $conexion = null;
        }
    }
}
$mensajeRegistro = "Estas registrado <a href='login.php'> Inicia sesión </a>.";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Feedback-TerezaFranco</title>
</head>

<body>

    <?php
   // Mostrar un mensaje de Registro  o un Mensaje en caso de Error.
    if (isset($mensajeErrorRegistro)) {
        echo "<p>$mensajeErrorRegistro</p>";
    }
    if (isset($mensajeExitoRegistro)) {
        echo "<p>$mensajeExitoRegistro</p>";
    }
    if (isset($mensajeRegistro)) {
        echo "<p>$mensajeRegistro</p>";
    }
    ?>

    <h2>Registrarse</h2>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
    <br>

    <label for="apellido">Apellido:</label>
    <input type="text" name="apellido" id="apellido" placeholder="Apellido" required>
    <br>

    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" id="direccion" placeholder="Dirección" required>
    <br>

    <label for="telefono">Teléfono:</label>
    <input type="tel" name="telefono" id="telefono" placeholder="Teléfono" required>
    <br>

    <label for="email">Nuevo Usuario:</label>
    <input type="email" name="email" id="email" placeholder="Correo electrónico" autocomplete="username" required>
    <br>

    <label for="contrasenia_registro">Nueva Contraseña:</label>
    <input type="password" name="contrasenia_registro" id="contrasenia_registro" placeholder="Contraseña" required autocomplete="new-password">
    <br>

    <label for="confirmar_contrasenia">Repetir Contraseña:</label>
    <input type="password" name="confirmar_contrasenia" id="confirmar_contrasenia" placeholder="Confirmar Contraseña" required autocomplete="new-password">
    <br>

    <input type="submit" name="registrarse" value="Registrarse">
</form>

</body>

</html>