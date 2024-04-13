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
        var correo_existe = false 
        function validar(){
            var nombre = document.forms["formulario"]["nombre"].value;
            var apellidos = document.forms["formulario"]["apellidos"].value;
            var correo = document.forms["formulario"]["correo"].value;
            
            if (nombre !== "" && apellidos !== "" && correo !== "") {
                if(correo_existe!==false){
                    $('#mensaje').html('El correo ya existe');
                    setTimeout(function() {
                        $('#mensaje').html('');
                    }, 5000);
                    return false;
                }
                else{
                    return true;
                }
                
            } 
            else {
                $('#mensaje').html('Faltan por llenar campos');
                setTimeout(function() {
                    $('#mensaje').html('');
                }, 5000);
                return false; // Evita que el formulario se envíe
            }
        }
        function validarCorreo() {
        var correo = document.forms["formulario"]["correo"].value;
        var id = document.forms["formulario"]["id"].value;
        $.ajax({
            type: 'POST',
            url: 'funciones/validar_correo_editar.php',
            data: { 
                correo: correo,
                id: id },
            success: function(response) {
                if (response === 'existe') {
                    correo_existe = true;
                    $('#mensaje_correo').html('El correo ' + correo + ' no es posible');
                    setTimeout(function () {
                        $('#mensaje_correo').html('');
                    }, 5000);
                } else {
                    correo_existe = false;
                    $('#mensaje_correo').html('');
                }
            },
            error: function() {
                alert('Error al verificar el correo.');
            }
        });
    }
    </script>

</head>
<body>
    <?php include('templates/header.php');

    $sql = "SELECT * FROM lista_empleados WHERE id = " . $_SESSION['id'] . " AND status = 1 AND eliminado = 0";

    $res=$conexion->query($sql);
    $num= $res-> num_rows;
    

    if ($num===1){
        $row       = $res->fetch_array();
        $id        = $row['id'];
        $nombre    = $row['nombre']; 
        $apellidos = $row['apellidos'];
        $correo    = $row['correo'];
        $archivo   = $row['archivo'];
    }
    ?>


    <form id="formulario" name="Forma01" class="formulario"  action="funciones/edita_cuenta.php" method="post" enctype="multipart/form-data">
        <h2>Editar Cuenta</h2>
        <input type="hidden" name="id" value="<?php echo $id; ?>">


        <label for="">Nombre: </label>
        <input type="text" name="nombre" value="<?php echo $nombre; ?>"><br>
        
        <label for="">Apellidos: </label>
        <input type="text" name="apellidos" value="<?php echo $apellidos; ?>"><br>
        
        <label for="">Correo: </label>
        <input type="text" onblur="validarCorreo()" name="correo" value="<?php echo $correo; ?>"><br>

        <div id="mensaje_correo"></div>

        <label for="">Contraseña: </label>
        <input type="password" name="pass" placeholder="Ingrese contraseña nueva"><br>
        
        
        <input type="file" id="archivo" name="archivo"><br>

        <input type="submit" onclick="return validar(); " value="Actualizar">

        <a href="usuario_detalles.php">Regresar</a>
        <div id="mensaje"></div>
    </form>

    <?php
    include("templates/footer.php")
?>

</body>
</html>
