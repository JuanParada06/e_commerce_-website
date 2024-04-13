<?php
    // Aquí debes incluir la conexión a tu base de datos, similar a como lo has hecho en otros archivos PHP
    include("conexion.php");

    // Obtén el correo electrónico enviado desde la solicitud AJAX
    $id =$_POST['id'];
    $codigo = $_POST['codigo'];

    // Realiza la consulta para verificar si el correo ya existe
    $conexion = conectar(); // Asegúrate de llamar a la función conectar

    $sql = "SELECT * FROM productos WHERE codigo = '$codigo' AND status=1 AND eliminado=0";
    $result = mysqli_query($conexion, $sql);
    while ($mostrar = mysqli_fetch_array($result)) {
        if ($mostrar['codigo'] == $codigo){
            
            if($mostrar['codigo']==$codigo and $mostrar['id']==$id){
                $correo_existente = false;
                break;
            }

            else{
                $correo_existente = true;}
        }
    }

    if ($correo_existente) {
        echo 'existe';
    }
    else {
        echo 'no_existe'; // El correo no existe en la base de datos
    }
?>