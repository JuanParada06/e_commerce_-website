<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index1.php");
    exit(); 
}

$tipo    = $_SESSION['tipo'];
$usuario = $_SESSION['usuario'];
?>
