
<?php
    require "conexion.php";

    $conexion = conectar();
    $id = $_REQUEST['id'];
    $nombreEmpleado = $_REQUEST['nombre']; // Recibir el nombre del empleado

    $sql = "UPDATE lista_empleados SET eliminado = 1 WHERE id = $id";

    $res = $conexion->query($sql);
    if ($res) {
        echo "Usuario eliminado: $nombreEmpleado"; // Mostrar el nombre del usuario eliminado
    } else {
        echo "Error al eliminar el usuario";
    }

    // Esto redirigirá a la página empleados_lista.php después de ejecutar la consulta
    header("Location: ../empleados_lista.php");
?>