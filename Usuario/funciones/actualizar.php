<?php
// actualizar_cantidad.php
    $id = $_POST['id_pedido'];
    $id_producto = $_POST['id_producto'];
    $nueva_cantidad = $_POST['cantidad'];
    include("conexion.php");
    
    $conexion = conectar();
    // Actualiza la cantidad en la base de datos
    $sql = "UPDATE pedidos_productos SET cantidad = $nueva_cantidad WHERE id_pedido = $id AND id_producto =$id_producto";

    $res = $conexion->query($sql);
    if ($res) {
        echo "Producto actualizado";
    }
    // Cierra la conexión
    $conexion->close();


