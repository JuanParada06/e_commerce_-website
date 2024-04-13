<?php include('funciones/Sesion.php');?>

<html>
    <head>
        <title> AGREGAR EMPLEADO</title>
        <script src="js/jquery-3.3.1.min.js"></script>
        <link rel="stylesheet" href="css/style_alta.css">
        <script>
            function validar(){
                var nombre = document.Forma01.nombre.value;
                var archivo=document.Forma01.archivo.value;
                
                if (nombre !== "" && archivo !=="") {
                    return true;}
                else{
                    $('#mensaje').html('Faltan Campos de ser llenados');
                        setTimeout(function() {
                            $('#mensaje').html('');
                        }, 5000);
                    return false;
                }
            }
        </script>
    </head>

    <body>
    <?php include('templates/header.php');?>


        <div class= "formulario">
            <h2>AGREGAR PROMOS</h2>

            <form id="Forma01" name="Forma01" action="funciones/salva_promos.php" method="post" enctype="multipart/form-data">
                <label>Nombre: </label>
                <input type="text" name="nombre" placeholder="Escribe tu nombre"/><br>

                <input type="file" id="archivo" name="archivo"><br><br>

                <input type="submit" onclick="return validar();" value="Registrar" />
                <a href="promos_lista.php">Regresar</a>
                <div id="mensaje"></div>


            </form>
                
        </div>



    </body>
</html>