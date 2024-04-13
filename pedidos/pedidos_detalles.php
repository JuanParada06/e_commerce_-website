<?php include('funciones/Sesion.php');?>

<html>
<head>
    <script src="js/jquery-3.3.1.min.js"></script>
    <title>Lista de Productos</title>
    <link rel="stylesheet" href="css/style_pedidos.css">

</head>

<body>

<?php
include('templates/header.php');
include("funciones/conexion.php");

$conexion = conectar();
$id_pedido = isset($_GET['id']) ? $_GET['id'] : null;
$status = isset($_GET['status']) ? $_GET['status'] : null;
$total=0;

$sql = "SELECT * FROM pedidos_productos WHERE id_pedido = '$id_pedido'";
$res=$conexion->query($sql);
$num= $res-> num_rows;
?>

<div class="contenedor">
    <table>
        <thead>
            <tr>
                <td colspan="8" align="center">LISTA PEDIDOS</td>
            </tr>
            <tr>
                <td>ID</td>
                <td>Id del pedido</td>
                <td>Id del Productos</td>
                <td>Nombre del Producto</td>
                <td>Cantidad</td>
                <td>Precio</td>
                <td>Subtotal</td>
                <td>Total</td>

            </tr>
        </thead>
        <?php 
            while ($row = $res->fetch_array()) {
                $id=$row['id'];
                $id_producto = $row['id_producto'];
            
                $sql_producto = "SELECT * FROM productos WHERE id = '$id_producto'";
                $res_producto=$conexion->query($sql_producto);
                $num_producto= $res_producto-> num_rows;
                if ($num_producto===1){
                    $row_producto = $res_producto->fetch_array();
                    $producto = $row_producto['nombre'];
                }
                $cantidad = $row['cantidad'];
                $precio = $row['precio'];
                $subtotal=$cantidad*$precio;
                $total+=$subtotal;
                ?>
            <tr class="listas">
                <td><?php echo $id ?></td>
                <td><?php echo $id_pedido?></td>
                <td><?php echo $id_producto?></td>
                <td><?php echo $producto ?></td>
                <td><?php echo $cantidad ?></td>
                <td><?php echo $precio ?> $</td>
                <td><?php echo $subtotal ?> $</td>  
                <td></td>

            </tr>

            <?php }?>
            <tr class="listas">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

                <td><?php echo $total ?> $</td> 
            </tr>
            <?php
            if($status=='Activo'){?>
        <tr class="agregar">
            <td  colspan="8" align="center" > <a href="producto_alta.php?id_pedido=<?php echo $id_pedido;?>&status=<?php echo $status;?>" class="Registro">Agregar Productos</a></td>
        </tr>
        <?php }?>
        <tr class="agregar">
            <td  colspan="8" align="center" > <a href="pedidos_lista.php" class="Registro">REGRESAR</a></td>
        </tr>
    </table>
</div>

<?php
mysqli_close($conexion);
?>

</body>
</html>
