<?php
// Incluye la conexión a la base de datos
include("conexion.php");

// Obtén el id enviado desde la solicitud AJAX
$producto = $_POST['producto'];

// Realiza la consulta para verificar si el id ya existe
$conexion = conectar(); // Asegúrate de llamar a la función conectar

// Utiliza una consulta preparada para evitar problemas de seguridad
$sql = "SELECT * FROM productos WHERE id = '$producto'";
$res=$conexion->query($sql);
$num= $res-> num_rows;
while ($row = $res->fetch_array()) {
    $nombre=$row['nombre'];}
    
// Verifica el resultado de la consulta
if ($res) {
    // Verifica si hay al menos una fila
    if (mysqli_num_rows($res) > 0) {

        echo $nombre;
    } else {
        echo 'no_existe'; // El id no existe en la base de datos
    }
} else {
    // Maneja el error de la consulta
    echo 'error';
}

// Cierra la conexión a la base de datos
mysqli_close($conexion);
?>
