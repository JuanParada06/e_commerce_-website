<?php
// Incluye la conexión a la base de datos
include("conexion.php");

// Obtén los datos enviados desde la solicitud AJAX
$producto = $_POST['producto'];
$cantidad = $_POST['cantidad'];

// Realiza la consulta para verificar la cantidad en stock
$conexion = conectar(); // Asegúrate de llamar a la función conectar
// Utiliza una consulta preparada para evitar problemas de seguridad
$sql = "SELECT * FROM productos WHERE id = '$producto'";
$res = $conexion->query($sql);

// Verifica el resultado de la consulta
if ($res) {
    // Verifica si hay al menos una fila
    if (mysqli_num_rows($res) > 0) {

        $row = $res->fetch_array();
        $stock = $row['stock'];
        if($cantidad<$stock)
        echo ""; // Devuelve la cantidad disponible en stock
        else{
            echo $stock;
        }
    } else {
        echo 'no_existe'; // El producto no existe en la base de datos
    }
} else {
    echo 'error'; // Maneja el caso de error en la consulta
}


// Cierra la conexión a la base de datos
mysqli_close($conexion);
?>
