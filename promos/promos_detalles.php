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

    <form name="formulario" method="post">
        <h2>Detalles del Producto</h2>
        
        <table>
            <tr>
                <img src="../archivos/promo/<?php echo $archivo?>" alt="Descripción de la imagen" ></td>
            </tr>
            <tr>
                <label for="">Nombre: <?php echo $nombre?></label><br>

            </tr>
        </table>
        
        <a href="promos_lista.php">Regresar</a>
    </form>
    

</body>
</html>
