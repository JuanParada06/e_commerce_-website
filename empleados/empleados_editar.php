
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
            var rol = document.forms["formulario"]["rol"].value;
            
            if (nombre !== "" && apellidos !== "" && correo !== "" && rol !== "0") {
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
                    $('#mensaje_correo').html('El correo ' + correo + ' ya existe');
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
    <?php include('templates/header.php');?>

    <?php
    $id = isset($_GET['id']) ? $_GET['id'] : null;


    if($id) {
        $sql = "SELECT * FROM lista_empleados WHERE id = '".$id."'";
        $resultado = mysqli_query($conexion, $sql);
        $mostrar = mysqli_fetch_assoc($resultado);
        
        if($mostrar){
            $nombre = $mostrar["nombre"];
            $apellidos = $mostrar["apellidos"];
            $correo = $mostrar["correo"];
            $password = $mostrar["pass"];
            $rol = $mostrar["rol"];
            $achivo= $mostrar["archivo"];
        } else {
            // Aquí puedes manejar el caso cuando no se encuentran datos para el 'id' proporcionado.
        }
    } else {
        // Aquí puedes manejar el caso cuando no se proporciona ningún 'id' en la URL.
    }
    ?>


    <form id="formulario" name="Forma01" class="formulario"  action="funciones/edita_empleados.php" method="post" enctype="multipart/form-data">
        <h2>Editar Empleado</h2>
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
        
        <label>Rol: </label>
        <select name="rol" id="rol">
            <option value="0" <?php if ($rol == 0) echo 'selected'; ?>>Selecciona</option>
            <option value="1" <?php if ($rol == 1) echo 'selected'; ?>>Usuario</option>
            <option value="2" <?php if ($rol == 2) echo 'selected'; ?>>Empleado</option>
            <option value="3" <?php if ($rol == 3) echo 'selected'; ?>>Administrador</option>

        </select><br>
        
        <input type="file" id="archivo" name="archivo"><br>

        <input type="submit" onclick="return validar(); " value="Actualizar">

        <a href="empleados_lista.php">Regresar</a>
        <div id="mensaje"></div>
    </form>


</body>
</html>
