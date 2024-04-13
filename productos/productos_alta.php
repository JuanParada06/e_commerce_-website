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
            <h2>AGREGAR PRODUCTOS</h2>

            <form id="Forma01" name="Forma01" action="funciones/salva_productos.php" method="post" enctype="multipart/form-data">
                <label>Nombre: </label>
                <input type="text" name="nombre" placeholder="Escribe el nombre del libro"/><br>

                <label>Autor: </label>
                <input type="text" name="autor" placeholder="Escribe el autor"/><br>

                <label>Codigo: </label>
                <input type="text" onblur="validarcodigo()" name="codigo" placeholder="Escribe el codigo"/><br>
                <div id="mensaje_correo"></div>

                <label>Descripcion: </label>
                <textarea name="descripcion" cols="30" rows="5" style="width: 100%;"></textarea>

                <label>Costo: </label>
                <input type="number" name="costo" min="0" placeholder="Ingresa el costo"  /><br>
                
                <label>stock: </label>
                <input type="number" name="stock" min="0" placeholder="Cantidad"/><br>

                <input type="file" id="archivo" name="archivo"><br><br>

                <input type="submit" onclick="return validar();" value="Registrar" />
                
                <a href="productos_lista.php">Regresar</a>
                <div id="mensaje"></div>
            </form>
                
        </div>
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
                
                if (nombre !== "" && descripcion !== "" && costo!=="" && codigo !== "" && stock !== "" && archivo !=="") {
                    if(codigo_existe!==false){
                        $('#mensaje').html('El codigo ya existe');
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
            function validarcodigo(){
                var codigo = document.Forma01.codigo.value;
                $.ajax({
                    type: 'POST',
                    url: 'funciones/validar_codigo.php',
                    data: { codigo: codigo },
                    success: function(response) {
                        if (response === 'existe') {
                            codigo_existe = true;

                            $('#mensaje_correo').html('El codigo ya existe');
                            setTimeout(function () {
                            $('#mensaje_correo').html('');
                            }, 5000);
                            return false;
                             // Evita que el formulario se envíe
                        } 
                        else{
                            codigo_existe = false;
                            return true;
                        }
                        }
                    });
            }
        </script>


    </body>
</html>