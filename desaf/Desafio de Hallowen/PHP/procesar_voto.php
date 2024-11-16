<?php
session_start();
include 'conexion.php'; // Incluye el archivo de conexión

// Comprobamos si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $participante_id = $_POST['participante_id']; // ID del participante que recibió el voto
    $usuario_id = $_SESSION['usuario_id']; // ID del usuario que vota (asumiendo que está en la sesión)

    // Validación simple
    if (empty($participante_id) || empty($usuario_id)) {
        $_SESSION['error'] = "Error al procesar el voto. Intenta de nuevo.";
        header("Location: pagina_votacion.php"); // Redirigir a la página de votación
        exit();
    }

    // Comprobar si el usuario ya ha votado
    $stmt = $pdo->prepare("SELECT * FROM votos WHERE usuario_id = :usuario_id");
    $stmt->bindParam(':usuario_id', $usuario_id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['error'] = "Ya has votado. No puedes votar de nuevo.";
        header("Location: pagina_votacion.php"); // Redirigir a la página de votación
        exit();
    }

    // Insertar el voto en la base de datos
    $stmt = $pdo->prepare("INSERT INTO votos (participante_id, usuario_id) VALUES (:participante_id, :usuario_id)");
    $stmt->bindParam(':participante_id', $participante_id);
    $stmt->bindParam(':usuario_id', $usuario_id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $_SESSION['success'] = "Voto registrado exitosamente.";
    } else {
        $_SESSION['error'] = "Error al registrar el voto. Intenta de nuevo.";
    }

    // Redirigir a la página de votación
    header("Location: pagina_votacion.php"); // Redirigir a la página de votación
    exit();
}
?>
