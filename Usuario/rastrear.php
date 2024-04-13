<?php
include('funciones/Sesion.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pedidos</title>
    <link rel="stylesheet" href="css/style_rastreo.css">
</head>
<body>
    <?php include('templates/header.php'); ?>
    <div class="contenedor">
        <h1>Lista de Pedidos</h1>
        <table>
            <tr>
            <td colspan="6" class="regreso"><a href="usuario_detalles.php">REGRESAR</a></td>

            </tr>
            <thead>

                <tr>
                    <th>ID del Pedido</th>
                    <th>Fecha de Pedido</th>
                    <th>Estado del Pedido</th>
                    <th>Clave de Rastreo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("funciones/conexion.php");
                $conexion = conectar();
                $id_usuario = $_SESSION["id"];
                $sql = "SELECT * FROM pedidos WHERE id_usuario='$id_usuario'";
                $resultados = $conexion->query($sql);

                while ($row = $resultados->fetch_assoc()) {
                    $id_pedido = $row['id'];
                    $fecha_pedido = $row['fecha'];
                    $estado_pedido = $row['status'];
                    $clave_rastreo = $row['clave'];

                    if($estado_pedido=="1"){
                        $estado_pedido="enviado";
                    }
                    else{
                        $estado_pedido="en proceso";
                    }

                    echo "<tr>";
                    echo "<td>$id_pedido</td>";
                    echo "<td>$fecha_pedido</td>";
                    echo "<td>$estado_pedido</td>";
                    echo "<td>$clave_rastreo</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
