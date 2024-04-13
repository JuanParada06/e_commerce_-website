
<?php
function conectar()
{
    $server = "localhost:3307";
    $user = "root";
    $pass = "";
    $db = "empresa";

    // Crear conexión
    $conexion = mysqli_connect($server, $user, $pass, $db);

    // Verificar conexión
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    return $conexion;
}
?>