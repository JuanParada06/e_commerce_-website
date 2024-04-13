<?php
    require "conexion.php";

    $conexion = conectar();
    $id = $_REQUEST['id'];
    
    $nombreProducto = $_REQUEST['nombre']; // Recibir el nombre del Producto

    $sql = "UPDATE promociones SET eliminado = 1 WHERE id = $id";

    $res = $conexion->query($sql);
    if ($res) {
        echo "Poducto eliminado: $nombreProducto"; // Mostrar el nombre del usuario eliminado
    } else {
        echo "Error al eliminar el usuario";
    }

?>