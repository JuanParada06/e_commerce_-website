<?php
    // Incluye la conexión a la base de datos
    include("conexion.php");

    // Obtén el usuario enviado desde la solicitud AJAX
    $usuario = $_POST['usuario'];

    // Realiza la consulta para verificar si el usuario ya existe
    $conexion = conectar(); // Asegúrate de llamar a la función conectar

    // Utiliza una consulta preparada para evitar problemas de seguridad
    $sql = "SELECT * FROM pedidos WHERE id_usuario = '$usuario' AND status = 0";
    $result = mysqli_query($conexion, $sql);

    // Verifica el resultado de la consulta
    if ($result) {
        // Verifica si hay al menos una fila
        if (mysqli_num_rows($result) > 0) {
            echo 'existe';
        } else {
            echo 'no_existe'; // El usuario no existe en la base de datos o no está activo
        }
    } else {
        // Maneja el error de la consulta
        echo 'error';
    }

    // Cierra la conexión a la base de datos
    mysqli_close($conexion);
?>
