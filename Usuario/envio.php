<?php include('funciones/Sesion.php');?>

<!DOCTYPE html>

<html lang="es">
<head>
    <title>Formulario de Pago</title>
    <script src="js/jquery-3.3.1.min.js" ></script>
    <link rel="stylesheet" href="css/style_envio.css">

</head>
<body>
    <?php 
    include('templates/header.php');
    include("funciones/conexion.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Acceder a los datos del formulario
        $id_pedido = $_POST["id_pedido"];
        $cantidad = $_POST['cantidad'];
        $total_x = $_POST["total"];
        $envio = $_POST["envio"];
        $total = $envio+$total_x;

    } else {
        // Si no se ha enviado el formulario, inicializar las variables
        $id_pedido = "";
        $cantidad = "";
        $total = "";
    }
    ?>


    <h1>Formulario de Pago</h1>
    <form name="formulario" method="post" action="funciones/finalizar.php">
        <input type="hidden" name="cantidad" value="<?php echo $cantidad; ?>">
        <input type="hidden" name="id_pedido" value="<?php echo $id_pedido; ?>">
        <input type="hidden" name="total" value="<?php echo $total; ?>">
        
        <h2>Datos de la Tarjeta</h2>
        <label for="">Número de Tarjeta:</label>
        <input type="text" id="numero_tarjeta" name="numero_tarjeta" required><br><br>
        
        <label for="">Nombre del Titular:</label>
        <input type="text" id="nombre_titular" name="nombre_titular" required><br><br>
        
        <label for="">Fecha de Vencimiento:</label>
        <input type="text" id="fecha_vencimiento" name="fecha_vencimiento" placeholder="MM/YY" required><br><br>
        
        <label for="">Código de Seguridad:</label>
        <input type="text" id="codigo_seguridad" name="codigo_seguridad" maxlength="3" required><br><br>
        
        <h2>Datos de Envío</h2>
        <label for="">Dirección de Envío:</label>
        <input type="text" id="direccion" name="direccion" required><br><br>
        
        <label for="">Ciudad:</label>
        <input type="text" id="ciudad" name="ciudad" required><br><br>
        
        <label for="">Código Postal:</label>
        <input type="text" id="codigo_postal" name="codigo_postal" required><br><br>

        <input type="submit" value="Pagar">
    </form>

</body>
</html>
