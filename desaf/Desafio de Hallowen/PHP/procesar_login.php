<?php
session_start();
require 'conexion.php'; // Incluye el archivo de conexión

// Comprobamos si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['username']; // Cambia 'username' si es diferente en tu formulario
    $contraseña = $_POST['password']; // Cambia 'password' si es diferente en tu formulario

    // Preparamos y ejecutamos la consulta
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = :username");
    $stmt->bindParam(':username', $usuario);
    $stmt->execute();
    
    // Comprobamos si existe el usuario
    if ($stmt->rowCount() > 0) {
        $usuarioEncontrado = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificamos la contraseña (asegúrate de que las contraseñas se almacenen usando hash)
        if (password_verify($contraseña, $usuarioEncontrado['password'])) {
            // Autenticación exitosa, guardar datos del usuario en sesión
            $_SESSION['usuario_id'] = $usuarioEncontrado['id']; // Cambia 'id' según tu tabla
            $_SESSION['usuario'] = $usuarioEncontrado['username'];
            header("Location: dashboard.php"); // Redirigir a la página de éxito
            exit();
        } else {
            // Contraseña incorrecta
            $error = "Contraseña incorrecta.";
        }
    } else {
        // Usuario no encontrado
        $error = "Usuario no encontrado.";
    }
}

// Si hay un error, redirige a la página de login con el mensaje de error
if (isset($error)) {
    $_SESSION['error'] = $error;
    header("Location: login.php"); // Redirigir a la página de login
    exit();
}
?>
