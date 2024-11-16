// script.js

// Espera a que el DOM esté completamente cargado
document.addEventListener("DOMContentLoaded", function() {
    // Selecciona todos los botones de votar
    const botonesVotar = document.querySelectorAll('.votar');

    // Agrega un evento de clic a cada botón de votar
    botonesVotar.forEach(function(boton) {
        boton.addEventListener('click', function(event) {
            // Evita que el botón se presione múltiples veces
            event.target.disabled = true;

            // Muestra un mensaje de éxito
            mostrarMensajeExito(event.target);
        });
    });
});

// Función para mostrar un mensaje de éxito
function mostrarMensajeExito(boton) {
    // Crea un mensaje
    const mensaje = document.createElement('div');
    mensaje.textContent = "¡Gracias por votar!";
    mensaje.style.color = "#ff7518";
    mensaje.style.fontSize = "1.2rem";
    mensaje.style.marginTop = "10px";
    mensaje.style.textAlign = "center";

    // Inserta el mensaje después del botón
    boton.parentNode.insertBefore(mensaje, boton.nextSibling);
}
