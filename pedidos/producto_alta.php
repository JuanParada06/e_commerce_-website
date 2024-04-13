<?php include('funciones/Sesion.php'); ?>
<html>

<head>
    <title>AGREGAR PEDIDO</title>
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="css/style_alta.css">
</head>

<body>
    <?php include('templates/header.php'); 
    $id_pedido = isset($_GET['id_pedido']) ? $_GET['id_pedido'] : null;
    $status = isset($_GET['status']) ? $_GET['status'] : null;?>

    <div class="formulario">
        <h2>AGREGAR PEDIDO</h2>

        <form id="Forma01" name="Forma01" action="funciones/salva_producto.php" method="post">
            <input type="hidden" name="id_pedido" value="<?php echo $id_pedido; ?>">
            <input type="hidden" name="status" value="<?php echo $status; ?>">

            <label>ID del producto</label>
            <input type="text" onchange="validar_producto()" name="producto" placeholder="Escribe el ID del producto">
            <div id="mensaje_producto"></div>

            <label>Cantidad </label>
            <input type="number" min="1" max="30" name="cantidad" onchange="validar_cantidad()" placeholder="Ingresa la cantidad">
            <div id="mensaje_stock"></div>

            <!-- Agregué un campo oculto para almacenar el estado del usuario -->
            <input type="submit" onclick="return validar();" value="Registrar" />

            <a href="pedidos_detalles.php?id=<?php echo $id_pedido;?>&status=<?php echo $status;?>">REGRESAR</a>
            <div id="mensaje"></div>
        </form>
    </div>

    <script>
        var existe_usuario = 0;
        var existe_stock = 0;

        function validar() {
            var producto = document.Forma01.producto.value;
            var cantidad = document.Forma01.cantidad.value;
            if (producto !== "" && cantidad !== "" ) {
                if (existe_usuario === 0 || existe_stock === 0) {
                    $('#mensaje').html('No puedes hacer este registro');
                    setTimeout(function () {
                        $('#mensaje').html('');
                    }, 5000);
                    return false;
                } else {
                    return true;
                }
            } else {
                $('#mensaje').html('Faltan por llenar campos');
                setTimeout(function () {
                    $('#mensaje').html('');
                }, 5000);
                return false; // Evita que el formulario se envíe
            }
        }

        function validar_producto() {
            var producto = document.Forma01.producto.value;
            if (producto !== "") {
                $.ajax({
                    type: 'POST',
                    url: 'funciones/validar_producto.php',
                    data: { producto: producto },
                    success: function (response) {
                        if (response !== '') {
                            existe_usuario = 1;
                            $('#mensaje_producto').html('El nombre del Producto es: ' + response);
                            producto = response; // Actualiza la variable global producto
                            setTimeout(function () {
                                $('#mensaje_producto').html('');
                            }, 5000);
                        } else {
                            existe_usuario = 0;
                        }
                    },
                    error: function () {
                        // Manejar errores de AJAX aquí
                    }
                });
            }
        }

        function validar_cantidad() {
            var producto = document.Forma01.producto.value;
            var cantidad = document.Forma01.cantidad.value;
            if (producto !== "") {
                $.ajax({
                    type: 'POST',
                    url: 'funciones/procesar_producto.php',
                    data: { producto: producto, cantidad: cantidad },
                    success: function (stock) {
                        if (stock !== '') {
                            existe_stock = 0;
                            $('#mensaje_stock').html('El producto solo tiene: ' + stock + ' en stock');
                            setTimeout(function () {
                                $('#mensaje_stock').html('');
                            }, 5000);
                        } else {
                            existe_stock = 1;
                        }
                    },
                    error: function () {
                        // Manejar errores de AJAX aquí
                    }
                });
            } else {
                $('#mensaje_stock').html('Ingrese el Id del producto primero');
                setTimeout(function () {
                    $('#mensaje_stock').html('');
                }, 5000);
            }
        }
    </script>
</body>

</html>
