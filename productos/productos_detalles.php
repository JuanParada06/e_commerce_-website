<?php include('funciones/Sesion.php');?>


<html>
<head>
    <title>Editar</title>
    <?php 
        include("funciones/conexion.php");
        $conexion = conectar();
    ?>
    <script src="js/jquery-3.3.1.min.js" ></script>
    <link rel="stylesheet" href="css/style_detalles.css">

</head>
<body>
    <?php include('templates/header.php');?>



    <?php
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    $nombre = "";
    $codigo= "";
    $descripcion = "" ;
    $costo = ""; 
    $stock="";
    $autor="";


    if($id) {
        $sql = "SELECT * FROM productos WHERE id = '".$id."'";
        $resultado = mysqli_query($conexion, $sql);
        $mostrar = mysqli_fetch_assoc($resultado);
        
        if($mostrar){
            $nombre = $mostrar["nombre"];
            $codigo = $mostrar["codigo"];
            $autor = $mostrar["autor"];
            $descripcion = $mostrar["descripcion"];
            $costo = $mostrar["costo"];
            $stock=$mostrar["stock"];
            $archivo_n=$mostrar["archivo_n"];
        } else {
            // Aquí puedes manejar el caso cuando no se encuentran datos para el 'id' proporcionado.
        }
    } else {
        // Aquí puedes manejar el caso cuando no se proporciona ningún 'id' en la URL.
    }
    ?>

    <form name="formulario" method="post">
        <h2>Detalles del Producto</h2>
        
        <table>
            <tr>
                <td>
                    <img src="../archivos/<?php echo $archivo_n?>" alt="Descripción de la imagen" width="50px" height="50px">
                </td>
                <td>
                    <label for="">Nombre: <?php echo $nombre?></label><br>
                    <label for="">Autor: <?php echo $autor?></label><br>
                    <label for="">Codigo: <?php echo $codigo; ?></label><br>
                    <label for="">Descripcion: <?php echo $descripcion; ?></label><br>
                    <label for="">Costo: <?php echo $costo; ?></label><br>
                    <label for="">Stock: <?php echo $stock; ?></label><br>

                    
                </td>
            </tr>
        </table>
        
        <a href="Productos_lista.php">Regresar</a>
    </form>
    

</body>
</html>
