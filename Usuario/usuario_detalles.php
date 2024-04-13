<?php include('funciones/Sesion.php');?>

<html>
<head>
    <title>Editar</title>
    <script src="js/jquery-3.3.1.min.js" ></script>
    <link rel="stylesheet" href="css/style_detalles.css">

</head>
<body>
    <?php include('templates/header.php');
    include("funciones/conexion.php");
    $conexion = conectar();
    
    $sql = "SELECT * FROM lista_empleados WHERE id = " . $_SESSION['id'] . " AND status = 1 AND eliminado = 0";

    $res=$conexion->query($sql);
    $num= $res-> num_rows;
    

    if ($num===1){
        $row = $res->fetch_array();
        $id = $row['id'];
        $usuario = $row['nombre'] . ' ' . $row['apellidos'];
        $correo  = $row['correo'];
        $archivo_n = $row['archivo_n'];
    }
    ?>

    <form>
        <h2>Detalles de Cuenta</h2>
        
        <table>
            <tr>
                <td>
                    <img src="../archivos/<?php echo $archivo_n?>" alt="Descripción de la imagen" width="50px" height="50px">
                </td>
                <td>
                    <label for="">Nombre: <?php echo $usuario; ?></label><br>
                    <label for="">Correo: <?php echo $correo; ?></label><br>
                    <a href="rastrear.php">Rastrear Pedidos</a>
                </td>
            </tr>
        </table>
        <a href="editar_cuenta.php">Editar Cuenta</a>
        <a href="../bienvenido.php">Regresar</a>
    </form>
    <?php
    include("templates/footer.php")
?>

</body>
</html>
