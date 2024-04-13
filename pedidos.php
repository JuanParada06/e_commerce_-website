<?php
include("Sesion.php");
include("Usuario/funciones/conexion.php");

$id_usuario = $_SESSION["id"];
$id_producto = $_POST["id"];
$stock = $_POST["stock"];
$cantidad = $_POST["cantidad"];
$precio = $_POST["costo"];

$conexion = conectar();

if ($conexion) {
    $sql_verificar_pedido_abierto = "SELECT id FROM pedidos WHERE id_usuario = '$id_usuario' AND status = 0";
    $resultado_verificar_pedido = mysqli_query($conexion, $sql_verificar_pedido_abierto);

    if (!$resultado_verificar_pedido) {
        die("Error al verificar el pedido abierto: " . mysqli_error($conexion));
    }

    if (mysqli_num_rows($resultado_verificar_pedido) == 0) {
        $fecha = date('Y-m-d');
        $sql_nuevo_pedido = "INSERT INTO pedidos (fecha, id_usuario, status) VALUES ('$fecha', '$id_usuario', 0)";

        if (!mysqli_query($conexion, $sql_nuevo_pedido)) {
            die("Error al crear un nuevo pedido: " . mysqli_error($conexion));
        }

        $id_pedido = mysqli_insert_id($conexion);
    } else {
        $row = mysqli_fetch_assoc($resultado_verificar_pedido);
        $id_pedido = $row['id'];
    }

    $sql_verificar_producto_en_pedido = "SELECT id, cantidad FROM pedidos_productos WHERE id_pedido = '$id_pedido' AND id_producto = '$id_producto'";
    $resultado_verificar_producto = mysqli_query($conexion, $sql_verificar_producto_en_pedido);

    if (!$resultado_verificar_producto) {
        die("Error al verificar el producto en el pedido: " . mysqli_error($conexion));
    }

    if (mysqli_num_rows($resultado_verificar_producto) == 0) {
        $sql_agregar_producto = "INSERT INTO pedidos_productos (id_pedido, id_producto, cantidad, precio) VALUES ('$id_pedido', '$id_producto', '$cantidad', '$precio')";

        if (!mysqli_query($conexion, $sql_agregar_producto)) {
            die("Error al agregar el producto al pedido: " . mysqli_error($conexion));
        }
    } else {
        $row_producto = mysqli_fetch_assoc($resultado_verificar_producto);
        $nueva_cantidad = $row_producto['cantidad'] + $cantidad;

        $sql_actualizar_cantidad = "UPDATE pedidos_productos SET cantidad = '$nueva_cantidad' WHERE id_pedido = '$id_pedido' AND id_producto = '$id_producto'";
        if (!mysqli_query($conexion, $sql_actualizar_cantidad)) {
            die("Error al actualizar la cantidad del producto en el pedido: " . mysqli_error($conexion));
        }
    }

    echo "Producto agregado al pedido con éxito";

    header("Location: bienvenido.php");
} else {
    echo "Error al conectar a la base de datos";
}
?>
