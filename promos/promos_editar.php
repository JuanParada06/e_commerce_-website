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
    <script>
        var codigo_existe = false 
        function validar(){
                var nombre = document.Forma01.nombre.value;
                var archivo=document.Forma01.archivo.value;
                
                if (nombre !== "") {
                        return true;
                    }
                     
                else {
                    
                    $('#mensaje').html('Faltan por llenar campos');
                    setTimeout(function() {
                        $('#mensaje').html('');
                    }, 5000);
                return false; // Evita que el formulario se envíe
                }
            }
    </script>
   
</head>
<body>
    <?php include('templates/header.php');?>

    <?php
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if($id) {
        $sql = "SELECT * FROM promociones WHERE id = '".$id."'";
        $resultado = mysqli_query($conexion, $sql);
        $mostrar = mysqli_fetch_assoc($resultado);
        
        if($mostrar){
            $nombre = $mostrar["nombre"];
            $archivo=$mostrar["archivo"];
        } else {
            // Aquí puedes manejar el caso cuando no se encuentran datos para el 'id' proporcionado.
        }
    } else {
        // Aquí puedes manejar el caso cuando no se proporciona ningún 'id' en la URL.
    }
    ?>


    <form id="formulario" name="Forma01" class="formulario"  action="funciones/edita_promos.php" method="post" enctype="multipart/form-data">
        <h2>Editar Pormociones</h2>

        <input type="hidden" name="id" value="<?php echo $id; ?>">


        <label for="">Nombre: </label>
        <input type="text" name="nombre" value="<?php echo $nombre; ?>"><br>

        <label for="">Archivo: <?php echo $archivo; ?> </label>
        <input type="file" id="archivo" name="archivo"><br>

        <input type="submit" onclick="return validar(); " value="Actualizar">

        <a href="promos_lista.php">Regresar</a>
        <div id="mensaje"></div>
    </form>

    

</body>

</html>
