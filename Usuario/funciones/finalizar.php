<?php
include("conexion.php");

// actualizar_cantidad.php

$id = $_POST['id_pedido'];
$cantidad = $_POST['cantidad'];
$total = $_POST['total'];

// Genera una clave aleatoria para el pedido
$clave_aleatoria = uniqid();

$conexion = conectar();

// Actualiza la cantidad y la clave en la base de datos
$sql_pedido = "UPDATE pedidos SET status = 1, clave = '$clave_aleatoria' WHERE id = $id";
$res_pedido = $conexion->query($sql_pedido);

if ($res_pedido) {
    // Inserta en la tabla de ventas
    $sql_ventas = "INSERT INTO ventas (id_pedido, total_pedido) VALUES ('$id', '$total')";
    $res_ventas = $conexion->query($sql_ventas);

    if ($res_ventas) {
        echo "Compra finalizada";
        // Ahora actualiza el stock de productos
        $sql_productos = "SELECT * FROM pedidos_productos WHERE id_pedido = $id";
        $res_productos = $conexion->query($sql_productos);

        while ($row = $res_productos->fetch_assoc()) {
            $id_producto = $row['id_producto'];
            $cantidad_producto = $row['cantidad'];

            // Actualiza el stock de cada producto
            $sql_stock = "UPDATE productos SET stock = stock - $cantidad_producto WHERE id = $id_producto";
            $res_stock = $conexion->query($sql_stock);

            if (!$res_stock) {
                echo "Error al actualizar el stock del producto";
                exit; // Sale del script si hay un error
            }
        }

        // Redirige después de todas las actualizaciones
        header("Location: ../../bienvenido.php");
    } else {
        echo "Error al insertar en la tabla de ventas";
    }
} else {
    echo "Error al finalizar la compra";
}

// Cierra la conexión
$conexion->close();
?>
