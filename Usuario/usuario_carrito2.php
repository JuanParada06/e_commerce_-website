<?php include('funciones/Sesion.php');?>

<html>
<head>
    <title>Finalizar Compra</title>
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="css/style_carrito.css">
</head>
<body>
    <?php include('templates/header.php');
    include("funciones/conexion.php");
    $conexion = conectar();

    // Verificar si la lista de productos está vacía
    $id_usuario = $_SESSION["id"];
    $sql = "SELECT * FROM pedidos WHERE id_usuario = '$id_usuario' AND status = 0";
    $res = $conexion->query($sql);
    $num = $res->num_rows;
    if ($num === 0) {
        header("Location: ../bienvenido.php");
        exit();
    }

    ?>
<form name="formulario" method="post" action="envio.php" onsubmit="return validarEnvio();">
    <?php
    $id_pedido="";
    $total=0;

    if ($num === 1){
        $row = $res->fetch_array();
        $id_pedido = $row['id'];
    }

    ?>
    <input type="hidden" name="id_pedido" value="<?php echo $id_pedido; ?>">

    <table border="1px">
        <tr class="encabezado">
            <td>Productos</td>
            <td>Cantidad</td>
            <td>Costo Unico</td>
            <td>Subtotal</td> 
            <td>Total</td>                          
        </tr>
        <?php
        $total = 0; // Inicializar el total

        $sql = "SELECT * FROM pedidos_productos WHERE id_pedido = '$id_pedido'";
        $res = $conexion->query($sql);
        while ($row = $res->fetch_array()) {
            $id_producto = $row['id_producto'];
            
            $sql_producto = "SELECT * FROM productos WHERE id = '$id_producto'";
            $res_producto = $conexion->query($sql_producto);
            $num_producto = $res_producto->num_rows;

            if ($num_producto === 1) {
                $row_producto = $res_producto->fetch_array();
                $producto = $row_producto['nombre'];
                $stock = $row_producto['stock'];
            }

            $cantidad = $row['cantidad'];
            $precio = $row['precio'];

            if ($cantidad > 0) {
                ?>
                <input type="hidden" name="cantidad" value="<?php echo $cantidad; ?>">

                <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
                <tr id="Fila<?php echo $id_producto; ?>">
                    <td><?php echo $producto ?></td>
                    <td> <?php echo $cantidad ?> </td>
                    <td><?php echo $precio ?>$</td>
                    <td><?php echo $precio * $cantidad ?>$</td>
                    <td class="encabezado"></td>
                <?php
                $subtotal = $precio * $cantidad;
                $total += $subtotal; // Agregar al total
            }
        }
        ?>
    <tr>
        <td><label for="">Escoge método de envío </label></td>  
        <td><input type="radio" name="envio" value="300" onclick="actualizarTotal(this.value)" <?php if(isset($envio) && $envio ==  "300") echo "checked"; ?>> DHL</td>
        <td><input type="radio" name="envio" value="250" onclick="actualizarTotal(this.value)" <?php if(isset($envio) && $envio ==  "250") echo "checked"; ?>> Fedex</td>
        <td><input type="radio" name="envio" value="270" onclick="actualizarTotal(this.value)" <?php if(isset($envio) && $envio == "270") echo "checked"; ?>> UPS</td>
        <input type="hidden" value="<?php echo $envio?>">
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td id="total"><?php echo $total ?>$ total</td>
        <input type="hidden" name="total" value="<?php echo $total; ?>">

    </tr>
        </table>

        <input type="submit" value="Finalizar" id="finalizarBtn" disabled>
        <a href="usuario_carrito.php">Regresar</a>

        </form>

    </form>
    <?php
    include("templates/footer.php")
?>
<script>
    function actualizarTotal(envio) {
        var total = <?php echo $total; ?>;
        total += parseInt(envio);
        document.getElementById('total').innerText = total + '$ total';
        document.getElementById('finalizarBtn').disabled = false; // Habilitar el botón de Finalizar
    }

    function validarEnvio() {
        var envioSeleccionado = document.querySelector('input[name="envio"]:checked');
        if (!envioSeleccionado) {
            alert('Por favor, selecciona un método de envío.');
            return false; // Evitar el envío del formulario si no se ha seleccionado un método de envío
        }
        return true; // Permitir el envío del formulario si se ha seleccionado un método de envío
    }
</script>
</body>
</html>
