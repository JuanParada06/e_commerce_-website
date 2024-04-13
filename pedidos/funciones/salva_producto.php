<?php
    include("Sesion.php");
    include("conexion.php");

    // Obtener el ID del usuario de la sesión
    $id_pedido =$_POST['id_pedido'];
    $id_producto = $_POST["producto"];
    $cantidad = $_POST["cantidad"];


    // Conectar a la base de datos
    $conexion = conectar();
    $sql = "SELECT * FROM productos WHERE id = '$id_producto'";
    $res=$conexion->query($sql);
    $num= $res-> num_rows;
    while ($row = $res->fetch_array()) {
        $id     =   $row['id'];
        $precio =   $row['costo'];

    // Verificar la conexión
    if ($conexion) {
        $sql = "INSERT INTO pedidos_productos (id_pedido,id_producto,cantidad,precio) VALUES ( '$id_pedido', '$id_producto','$cantidad','$precio')";
        if (mysqli_query($conexion, $sql)) {
            echo "Usuario registrado con éxito";
            header("Location: ../pedidos_lista.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
        }
    } else {
        echo "Error al conectar a la base de datos";
    }
        echo "Producto agregado al pedido con éxito";

        // Puedes redirigir al usuario a una página de confirmación u otra según tus necesidades
        header("Location: ../pedidos_lista.php");
        
    }
?>
