
<html>
    <head>
        <script src="js/jquery-3.3.1.min.js" > </script>
        <title>Lista de Usuarios</title>   
        <link rel="stylesheet" href="css/ventas.css">

    </head>

    <body>
    <?php include('templates/header.php');?>
    <br>

        <div class="contenedor">
            <table>
                <thead>
                    <td colspan="7" align="center">LISTA USUARIOS</td>
                    <tr >
                        <td>ID</td>
                        <td>ID_PEDIDO</td>
                        <td>TOTAL</td>
                        <td></td>
                    </tr>
                </thead>
                <!-- Seccion de php donde iniciara el while y acabara en las siguientes filas -->
            <?php
            include("conexion.php");
            $conexion = conectar(); // Asegúrate de llamar a la función conectar
            $sql = "SELECT * FROM ventas";
            $res = $conexion->query($sql);

            while ($row = $res->fetch_assoc()) {
                $id = $row['id'];
                $id_pedido = $row['id_pedido'];
                $total_pedido = $row['total_pedido'];
                $totalSumado += $total_pedido;
            ?>
                <tr id="Fila<?php echo $mostrar['id']; ?>" data-nombre="<?php echo $nombre; ?>" class="listas">
                    
                    <td><?php echo $id?> </td>
                    <td><?php echo $id_pedido?> </td>
                    <td><?php echo $total_pedido?>$ </td>

                    <td><a href="../pedidos/pedidos_detalles.php?id=<?php echo $id_pedido; ?>">Ver detalle</a></td>

                </tr>
                
                <?php
                    }
                
                ?>
                <tr class="listas">
                    <td>Total </td>
                    <td>Sumado  </td>
                    <td> <?php echo $totalSumado?>  </td>
                    <td>  $  </td>

                </tr>


            </table>
        </div>
        

        <?php
        mysqli_close($conexion);
        ?>


    </body>
</html>
