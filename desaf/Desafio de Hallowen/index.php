
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Evento de Concurso</title>
    <link rel="stylesheet" href="CSS/styles.css">
    
</head>
<body>

<?php
    require 'PHP/conexion.php';
    ?>
    <!-- Barra de navegación -->
    <nav>
        <ul>
            <li><a href="#lista-evento">Ver Participantes</a></li>
            <li><a href="#registro">Registro</a></li>
            <li><a href="#login">Iniciar Sesión</a></li>
            <li><a href="#admin">Panel de Administración</a></li>
        </ul>
    </nav>

    <!-- Encabezado principal -->
    <header>
        <h1>Evento de Concurso Halloween 2024</h1>
    </header>

    <!-- Contenido principal -->
    <main>
        <!-- Lista de participantes -->
        <section id="lista-evento" class="section">
            <h2>Lista de Participantes</h2>
            <div class="participante1">
                <h3>Participante 1</h3>
                <p>Disfraz 1</p>
                <img src="Images/disfraz1.avif" alt="Imagen de Participante 1" width="100%">
                <button class="votar">Votar</button>
            </div>
            <hr>
            <div class="participante2">
                <h3>Participante 2</h3>
                <p>Disfraz 2</p>
                <img src="Images/disfraz2.webp" alt="Imagen de Participante 2" width="100%">
                <button class="votar">Votar</button>
            </div>
        </section>

        <!-- Formulario de registro -->
        <section id="registro" class="section">
            <h2>Registro</h2>
            <form action="PHP/procesar_registro.php" method="POST">
                <label for="username">Nombre de Usuario:</label>
                <input type="text" id="username" name="username" required>
                
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
                
                <button type="submit">Registrarse</button>
            </form>
        </section>

        <!-- Formulario de inicio de sesión -->
        <section id="login" class="section">
            <h2>Iniciar Sesión</h2>
            <form action="PHP/procesar_login.php" method="POST">
                <label for="login-username">Nombre de Usuario:</label>
                <input type="text" id="login-username" name="login-username" required>
                
                <label for="login-password">Contraseña:</label>
                <input type="password" id="login-password" name="login-password" required>
                
                <button type="submit">Iniciar Sesión</button>
            </form>
        </section>

        <!-- Panel de administración -->
        <section id="admin" class="section">
            <h2>Panel de Administración</h2>
            <form action="PHP/procesar_participante.php" method="POST" enctype="multipart/form-data">
                <label for="nombre-participante">Nombre del Participante:</label>
                <input type="text" id="nombre-participante" name="nombre-participante" required>
                
                <label for="descripcion-participante">Descripción:</label>
                <textarea id="descripcion-participante" name="descripcion-participante" required></textarea>
                
                <label for="foto-participante">Foto:</label>
                <input type="file" id="foto-participante" name="foto-participante" required>

                <button type="submit">Agregar Participante</button>
            </form>
        </section>
    </main>

    <script src="Js/script.js"></script>
</body>
</html>
