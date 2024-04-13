<?php include('funciones/Sesion.php');?>


<html>
<head>
    <title>Editar</title>
    <?php 
        include("funciones/conexion.php");
        $conexion = conectar();
    ?>
    <script src="js/jquery-3.3.1.min.js" ></script>
    <link rel="stylesheet" href="css/style_editar.css">

   
</head>
<body>
    <?php include('templates/header.php');?>

    <?php
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if($id) {
        $sql = "SELECT * FROM productos WHERE id = '".$id."'";
        $resultado = mysqli_query($conexion, $sql);
        $mostrar = mysqli_fetch_assoc($resultado);
        
        if($mostrar){
            $nombre = $mostrar["nombre"];
            $autor = $mostrar["autor"];
            $codigo = $mostrar["codigo"];
            $descripcion = $mostrar["descripcion"];
            $costo = $mostrar["costo"];
            $stock=$mostrar["stock"];
            $archivo=$mostrar["archivo"];
        } else {
            // Aquí puedes manejar el caso cuando no se encuentran datos para el 'id' proporcionado.
        }
    } else {
        // Aquí puedes manejar el caso cuando no se proporciona ningún 'id' en la URL.
    }
    ?>


    <form id="formulario" name="Forma01" class="formulario"  action="funciones/edita_productos.php" method="post" enctype="multipart/form-data">
        <h2>Editar Producto</h2>

        <input type="hidden" name="id" value="<?php echo $id; ?>">


        <label for="">Nombre: </label>
        <input type="text" name="nombre" value="<?php echo $nombre; ?>"><br>

        <label for="">Autor: </label>
        <input type="text" name="autor" value="<?php echo $autor; ?>"><br>

        <label for="">Codigo: </label>
        <input type="text" name="codigo" onblur="validarcodigo()" value="<?php echo $codigo; ?>" ><br>      
        <div id="mensaje_correo"></div>

        <label for="">Descripcion: </label><br>
        <textarea name="descripcion" cols="30" rows="5" style="width: 100%;"><?php echo $descripcion; ?></textarea><br>
 

        <label for="">Costo: </label>

        <input type="text" name="costo" value="<?php echo $costo; ?>"><br>
        <label for="">Stock: </label>

        <input type="text" name="stock" value="<?php echo $stock; ?>"><br>

        <label for="">Archivo: <?php echo $archivo; ?> </label>
        <input type="file" id="archivo" name="archivo"><br>

        <input type="submit" onclick="return validar(); " value="Actualizar">

        <a href="productos_lista.php">Regresar</a>
        <div id="mensaje"></div>
    </form>

    
    <script>
        var codigo_existe = false 
        function validar(){
                var nombre = document.Forma01.nombre.value;
                var autor = document.Forma01.autor.value;
                var descripcion = document.Forma01.descripcion.value;
                var codigo = document.Forma01.codigo.value;
                var costo = document.Forma01.costo.value;
                var stock = document.Forma01.stock.value;
                var archivo=document.Forma01.archivo.value;
                
                if (nombre !== "" && autor !== "" && descripcion !== "" && costo !== "" && stock !== "") {
                    if (codigo_existe !== true) { // Aquí se verifica si codigo_existe es true
                        return true;
                        
                    } else {
                        $('#mensaje').html('El codigo ya existe');
                        setTimeout(function () {
                            $('#mensaje').html('');
                        }, 5000);
                        return false;
                    }
                } else {
                    $('#mensaje').html('Faltan por llenar campos');
                    setTimeout(function () {
                        $('#mensaje').html('');
                    }, 5000);
                    return false; // Evita que el formulario se envíe
                }}

        function validarcodigo() {
        var codigo = document.Forma01.codigo.value;
        var id = document.Forma01.id.value;
        $.ajax({
            type: 'POST',
            url: 'funciones/validar_codigo_editar.php',
            data: { 
                codigo: codigo,
                id: id },
            success: function(response) {
                if (response === 'existe') {
                    codigo_existe = true;
                    $('#mensaje_correo').html('El codigo ' + codigo + ' ya existe');
                    setTimeout(function () {
                        $('#mensaje_correo').html('');
                    }, 5000);
                } else {
                    codigo_existe = false;
                    $('#mensaje_correo').html('');
                }
            },
            error: function() {
                alert('Error al verificar el codigo.');
            }
        });
    }
    </script>
</body>

</html>
