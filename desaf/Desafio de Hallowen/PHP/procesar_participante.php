<?php
session_start();
require 'conexion.php'; // Incluye el archivo de conexión

// Comprobamos si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre']; // Cambia 'nombre' según el campo en tu formulario
    $descripcion = $_POST['descripcion']; // Cambia 'descripcion' según el campo en tu formulario
    $imagen = $_FILES['imagen']['name']; // Nombre del archivo de imagen
    $rutaImagen = 'imagenes/' . basename($imagen); // Ruta donde se guardará la imagen

    // Validación simple
    if (empty($nombre) || empty($descripcion) || empty($imagen)) {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
        header("Location: formulario_participante.php"); // Redirigir al formulario de participante
        exit();
    }

    // Subir la imagen al servidor
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
        // Preparar la consulta para insertar en la base de datos
        $stmt = $pdo->prepare("INSERT INTO participantes (nombre, descripcion, imagen) VALUES (:nombre, :descripcion, :imagen)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':imagen', $rutaImagen);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            $_SESSION['success'] = "Participante agregado correctamente.";
        } else {
            $_SESSION['error'] = "Error al agregar el participante. Intenta de nuevo.";
        }
    } else {
        $_SESSION['error'] = "Error al subir la imagen.";
    }

    // Redirigir a la página de éxito o error
    header("Location: formulario_participante.php"); // Redirigir al formulario
    exit();
}
?>
