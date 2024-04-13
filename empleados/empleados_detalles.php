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
    $apellidos= "";
    $correo = "" ;
    $rol = ""; 
    $password="";

    if($id) {
        $sql = "SELECT * FROM lista_empleados WHERE id = '".$id."'";
        $resultado = mysqli_query($conexion, $sql);
        $mostrar = mysqli_fetch_assoc($resultado);
        
        if($mostrar){
            $nombre = $mostrar["nombre"];
            $apellidos = $mostrar["apellidos"];
            $correo = $mostrar["correo"];
            $rol = $mostrar["rol"];
            $status=$mostrar["status"];
            $achivo_n= $mostrar["archivo_n"];
        } else {
            // Aquí puedes manejar el caso cuando no se encuentran datos para el 'id' proporcionado.
        }
    } else {
        // Aquí puedes manejar el caso cuando no se proporciona ningún 'id' en la URL.
    }
    ?>

    <form name="formulario" action="edita_empleados.php" method="post">
        <h2>Detalles de Empleado</h2>
        
        <table class="tabla">
            <tr>
                <td>
                    <img src="../archivos/<?php echo $achivo_n?>" alt="Descripción de la imagen">
                </td>
                <td>
                    <table class="datos">
                        <tr>
                            <td><label for="">Nombre: <?php echo $nombre.' '.$apellidos; ?></label></td>
                        </tr>
                        <tr>
                            <td><label for="">Correo: <?php echo $correo; ?></label></td></tr>
                        <tr>
                            <td><label for="">Rol: <?php echo ($rol == 1) ? 'Gerente' : (($rol == 2) ? 'Ejecutivo' : ''); ?></label>    </td> </tr>
                        <tr>
                            <td><label for="">Status: <?php echo ($status == 1) ? 'Activo' : (($status == 0) ? 'Inactivo' : ''); ?></label></td>   </tr>
                    </table>
                </td>
            </tr>
        </table>
        
        <a href="empleados_lista.php">Regresar</a>
    </form>
    

</body>
</html>
