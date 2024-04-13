<?php
    // Incluye la conexión a la base de datos
    include("conexion.php");

    // Obtén el id enviado desde la solicitud AJAX
    $id = $_POST['id'];

    // Realiza la consulta para verificar si el id ya existe
    $conexion = conectar(); // Asegúrate de llamar a la función conectar

    // Utiliza una consulta preparada para evitar problemas de seguridad
    $sql = "SELECT * FROM pedidos WHERE id = '$id'";
    $result = mysqli_query($conexion, $sql);

    // Verifica el resultado de la consulta
    if ($result) {
        // Verifica si hay al menos una fila
        if (mysqli_num_rows($result) > 0) {
            echo 'existe';
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
