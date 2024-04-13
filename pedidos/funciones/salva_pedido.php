
<?php
    include("conexion.php");

    $fecha  =   $_POST['fecha'];
    $usuario=   $_POST['usuario'];
    // Conectar a la base de datos
    $conexion = conectar();
    // Verificar la conexión
    if ($conexion) {
        $sql = "INSERT INTO pedidos ( fecha, id_usuario) VALUES ( '$fecha', '$usuario')";
        if (mysqli_query($conexion, $sql)) {
            echo "Usuario registrado con éxito";
            header("Location: ../pedidos_lista.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
        }
    } else {
        echo "Error al conectar a la base de datos";
    }
    
?>