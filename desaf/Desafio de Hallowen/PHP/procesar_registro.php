<?php
session_start();
require 'conexion.php'; // Incluye el archivo de conexión

// Comprobamos si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre']; // Cambia 'nombre' según el campo en tu formulario
    $correo = $_POST['correo']; // Cambia 'correo' según el campo en tu formulario
    $contrasena = $_POST['contrasena']; // Cambia 'contrasena' según el campo en tu formulario

    // Validación simple
    if (empty($nombre) || empty($correo) || empty($contrasena)) {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
        header("Location: formulario_registro.php"); // Redirigir al formulario de registro
        exit();
    }

    // Comprobar si el correo ya está registrado
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE correo = :correo");
    $stmt->bindParam(':correo', $correo);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $_SESSION['error'] = "El correo ya está registrado.";
        header("Location: formulario_registro.php"); // Redirigir al formulario de registro
        exit();
    }

    // Hashear la contraseña
    $hashedPassword = password_hash($contrasena, PASSWORD_DEFAULT);

    // Preparar la consulta para insertar en la base de datos
    $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, correo, contrasena) VALUES (:nombre, :correo, :contrasena)");
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':contrasena', $hashedPassword);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $_SESSION['success'] = "Registro exitoso. Ahora puedes iniciar sesión.";
    } else {
        $_SESSION['error'] = "Error al registrar el usuario. Intenta de nuevo.";
    }

    // Redirigir a la página de éxito o error
    header("Location: formulario_registro.php"); // Redirigir al formulario
    exit();
}
?>
