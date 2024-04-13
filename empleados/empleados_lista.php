
<html>
    <head>
        <script src="js/jquery-3.3.1.min.js" > </script>
        <title>Lista de Usuarios</title>   
        <link rel="stylesheet" href="css/style_empleados.css">

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
                        <td>Nombre</td>
                        <td>Correo</td>
                        <td>Rol</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </thead>
                <!-- Seccion de php donde iniciara el while y acabara en las siguientes filas -->
            <?php
            include("funciones/conexion.php");
            $conexion = conectar(); // Asegúrate de llamar a la función conectar
            $sql = "SELECT * FROM lista_empleados";
            $result = mysqli_query($conexion, $sql); // Usa la conexión para ejecutar la consulta
            while ($mostrar = mysqli_fetch_array($result)) {
                if ($mostrar['eliminado'] == 0) {
                    if ($mostrar['rol'] == 1) {
                        $mostrar['rol'] = 'Usuario';
                    } else if ($mostrar['rol'] == 2) {
                        $mostrar['rol'] = 'Empleado';
                    }
                    else if ($mostrar['rol'] == 3) {
                        $mostrar['rol'] = 'Administrador';
                    }
                    $nombre = $mostrar['nombre'] . ' ' . $mostrar['apellidos'];
                ?>
                <tr id="Fila<?php echo $mostrar['id']; ?>" data-nombre="<?php echo $nombre; ?>" class="listas">
                    
                    <td><?php echo $mostrar['id']?> </td>
                    <td><?php echo $nombre?> </td>
                    <td><?php echo $mostrar['correo']?> </td>
                    <td><?php echo $mostrar['rol'] ?> </td>
                    <td><a href="javascript:void(0);" onclick="eliminar(<?php echo $mostrar['id']; ?>)">Eliminar</a></td>
                    <td><a href="empleados_detalles.php?id=<?php echo $mostrar['id']; ?>">Ver detalle</a></td>
                    <td><a href="empleados_editar.php?id=<?php echo $mostrar['id']; ?>">Editar</a></td>

                </tr>
                
                <?php
                    }
                }
                ?>
                <tr>
                    <td  class="agregar"colspan="7" align="center"> <div id="mensaje"></div> </td>
                </tr>
                <tr class="agregar">
                    <td  colspan="7" align="center" > <a href="empleados_alta.php" class="Registro">Nuevo Registro</a></td>
                </tr>

            </table>
        </div>
        
    <script>
    function eliminar(id) {
        var opcion = confirm("Deseas borrar al usuario con el id "+id);
        console.log("Entró");
        if (opcion) {
            var nombre = $('#Fila' + id).data('nombre');
            $.ajax({
                url: 'funciones/elimina_empleados.php',
                type: 'post',
                data: { id: id, nombre: nombre },
                success: function (res) {
                    console.log(res);
                    $('#Fila' + id).hide();
                    $('#mensaje').html('Usuario eliminado: ' + nombre);
                    setTimeout(function () {
                        $('#mensaje').html('');
                    }, 5000);
                },
                error: function () {
                    alert('Error: archivo no encontrado...');
                }
            });
        }
    }
    </script>

        <?php
        mysqli_close($conexion);
        ?>


    </body>
</html>
