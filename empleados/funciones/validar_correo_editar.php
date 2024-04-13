
<?php
    // Aquí debes incluir la conexión a tu base de datos, similar a como lo has hecho en otros archivos PHP
    include("conexion.php");

    // Obtén el correo electrónico enviado desde la solicitud AJAX
    $id =$_POST['id'];
    $correo = $_POST['correo'];

    // Realiza la consulta para verificar si el correo ya existe
    $conexion = conectar(); // Asegúrate de llamar a la función conectar

    $sql = "SELECT * FROM lista_empleados WHERE correo = '$correo' AND status=1 AND eliminado=0";
    $result = mysqli_query($conexion, $sql);
    while ($mostrar = mysqli_fetch_array($result)) {
        if ($mostrar['correo'] == $correo){
            
            if($mostrar['correo']==$correo and $mostrar['id']==$id){
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