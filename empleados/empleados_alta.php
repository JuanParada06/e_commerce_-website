<?php include('funciones/Sesion.php');?>
<html>
    <head>
        <title> AGREGAR EMPLEADO</title>
        <script src="js/jquery-3.3.1.min.js"></script>
        <link rel="stylesheet" href="css/style_alta.css">
    </head>

    <body>
    <?php include('templates/header.php');?>


        <div class= "formulario">
            <h2>AGREGAR EMPLEADO</h2>

            <form id="Forma01" name="Forma01" action="funciones/salva_empleados.php" method="post" enctype="multipart/form-data">
                <label>Nombre: </label>
                <input type="text" name="nombre" placeholder="Escribe tu nombre"/><br>
                <label>Apellidos: </label>
                <input type="text" name="apellidos" placeholder="Escribe tu apellidos"/><br>
                
                <label>Correo: </label>
                <input type="email" onblur="validarcorreo()" name="correo" placeholder="Escribe tu correo"/><br>
                <div id="mensaje_correo"></div>
                <label>Contraseña: </label>
                <input type="password" name="password" placeholder="Escribe tu password"/><br>
                <label>Rol: </label>
                <select name="rol" id="rol">
                    <option value="0">Selecciona</option>
                    <option value="1">Usuario</option>
                    <option value="2">Empleado</option>
                </select><br>

                <input type="file" id="archivo" name="archivo"><br><br>

                <input type="submit" onclick="return validar();" value="Registrar" />
                
                <a href="empleados_lista.php">REGRESAR</a>
                <div id="mensaje"></div>
            </form>
                
        </div>
        <script>
            var correo_existe = false 

            function validar(){
                var nombre = document.Forma01.nombre.value;
                var apellidos = document.Forma01.apellidos.value;
                var correo = document.Forma01.correo.value;
                var password = document.Forma01.password.value;
                var rol = document.Forma01.rol.value;
                var archivo=document.Forma01.archivo.value;
                
                if (nombre !== "" && apellidos !== "" && correo !== "" && password !== "" && rol !== "0" && archivo !=="" ) {
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
            function validarcorreo(){
                var correo = document.Forma01.correo.value;
                $.ajax({
                    type: 'POST',
                    url: 'funciones/validar_correo.php',
                    data: { correo: correo },
                    success: function(response) {
                        if (response === 'existe') {
                            correo_existe = true;

                            $('#mensaje_correo').html('El Correo ya existe');
                            setTimeout(function () {
                            $('#mensaje_correo').html('');
                            }, 5000);
                            return false;
                             // Evita que el formulario se envíe
                        } 
                        else{
                            correo_existe = false;
                            return true;
                        }
                        }
                    });
            }
        </script>


    </body>
</html>