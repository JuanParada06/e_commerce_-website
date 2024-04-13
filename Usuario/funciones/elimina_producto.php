
<?php
    require "conexion.php";

    $conexion = conectar();
    $id = $_REQUEST['id_pedido'];
    $id_producto =$_REQUEST['id_producto'];

    $sql = "DELETE FROM pedidos_productos WHERE id_pedido = $id AND id_producto = $id_producto";


    $res = $conexion->query($sql);
    if ($res) {
        echo "Producto eliminado"; // Mostrar el nombre del usuario eliminado
    } else {
        echo "Error al eliminar el usuario";
    }

    // Esto redirigirá a la página empleados_lista.php después de ejecutar la consulta
    header("Location: ../usuario_carrito.php");
?>