<?php
// Configuración de la conexión a la base de datos
$host = 'localhost'; // Cambia si es necesario
$db   = 'halloween'; // Nombre de tu base de datos
$user = 'root'; // Usuario de la base de datos
$pass = 'root'; // Contraseña de la base de datos

try {
    // Crear conexión
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    // Configurar el modo de error de PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("No se pudo conectar a la base de datos: " . $e->getMessage());
}
?>
