<?php include('funciones/Sesion.php');?>

<html>
<head>
    <script src="js/jquery-3.3.1.min.js"></script>
    <title>Lista de pedidos</title>
    <link rel="stylesheet" href="css/style_pedidos.css">
</head>

<body>

<?php
include('templates/header.php');
include("funciones/conexion.php");

$conexion = conectar();
$id_pedido = "";

$sql = "SELECT * FROM pedidos ";
$res = $conexion->query($sql);

?>

<div class="contenedor">
    <table>
        <thead>
            <tr>
                <td colspan="7" align="center">LISTA PEDIDOS</td>
            </tr>
            <tr>
                <td>ID</td>
                <td>Fecha</td>
                <td>Id_Usuario</td>
                <td>Status</td>
                <td></td>
            </tr>
        </thead>
        <?php 
        while ($row = mysqli_fetch_array($res)) {
            $id_pedido  =   $row['id'];
            $fecha      =   $row['fecha'];
            $id_usuario =   $row['id_usuario'];
            $status     =   $row['status'];
            if($status==0){
                $status="Activo";
            }
            else{
                $status="Cerrado";
            }
        ?>
        <tr id="Fila<?php echo $id_pedido; ?>" data-nombre="<?php echo $nombre; ?>" class="listas">
            <td><?php echo $id_pedido; ?></td>
            <td><?php echo $fecha; ?></td>
            <td><?php echo $id_usuario; ?></td>
            <td><?php echo $status; ?></td>
            <td><a href="pedidos_detalles.php?id=<?php echo $id_pedido; ?>&status=<?php echo $status; ?>">Ver detalle</a></td>

        </tr>
        <?php 
        }
        ?>
        <tr>
            <td  class="agregar"colspan="7" align="center"> <div id="mensaje"></div> </td>
        </tr>
        <tr class="agregar">
            <td  colspan="7" align="center" > <a href="pedido_alta.php" class="Registro">Agregar Pedido</a></td>
            
        </tr>

    </table>
</div>

<?php
mysqli_close($conexion);
?>

</body>
</html>
