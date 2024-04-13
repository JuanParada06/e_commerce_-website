<?php include('funciones/Sesion.php'); ?>
<html>

<head>
    <title>AGREGAR PEDIDO</title>
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="css/style_alta.css">
</head>

<body>
    <?php include('templates/header.php'); ?>

    <div class="formulario">
        <h2>AGREGAR PEDIDO</h2>

        <form id="Forma01" name="Forma01" action="funciones/salva_pedido.php" method="post">


            <label>Fecha: </label>
            <input type="date" name="fecha" /><br>

            <label>ID del Usuario: </label>
            <input type="text" onblur="validar_usuario()" name="usuario" placeholder="Escribe tu correo" /><br>
            <div id="mensaje_usuario"></div>
            <br>

            <input type="submit" onclick="return validar();" value="Registrar" />

            <a href="pedidos_lista.php">REGRESAR</a>
            <div id="mensaje"></div>
        </form>
    </div>
    <script>

        var existe_usuario = false;

        function validar() {

            var fecha = document.Forma01.fecha.value;
            var usuario = document.Forma01.usuario.value;

            if (fecha !== "" && usuario !== "") {
                if (existe_usuario === true) {
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

        function validar_usuario() {
            var usuario = document.Forma01.usuario.value;
            $.ajax({
                type: 'POST',
                url: 'funciones/validar_usuario.php',
                data: { usuario: usuario },
                success: function (response) {
                    if (response === 'existe') {
                        existe_usuario = true;

                        $('#mensaje_usuario').html('El usuario ya tiene un pedido activo');
                        setTimeout(function () {
                            $('#mensaje_usuario').html('');
                        }, 5000);
                    } else {
                        existe_usuario = false;
                    }
                },
                error: function () {
                    // Manejar errores de AJAX aquí
                }
            });
        }
    </script>
</body>

</html>
