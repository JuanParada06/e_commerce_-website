<?php
session_start();

// Si el usuario no ha iniciado sesión, simplemente continúa con el código
// No rediriges al usuario a la página de bienvenido
if (!isset($_SESSION['usuario'])) {
    // $tipo = $_SESSION['tipo'];
    // $usuario = $_SESSION['usuario'];
} else {
    // Si el usuario ha iniciado sesión, asigna los valores a las variables
    $tipo = $_SESSION['tipo'];
    $usuario = $_SESSION['usuario'];
}
?>
