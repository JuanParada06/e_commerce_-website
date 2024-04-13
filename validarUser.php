<?php
    session_start(); 
    // Aquí debes incluir la conexión a tu base de datos, similar a como lo has hecho en otros archivos PHP
    function conectar()
    {
        $server = "localhost:3307";
        $user = "root";
        $pass = "";
        $db = "empresa";
    
        // Crear conexión
        $conexion = mysqli_connect($server, $user, $pass, $db);
    
        // Verificar conexión
        if (!$conexion) {
            die("Error de conexión: " . mysqli_connect_error());
        }
    
        return $conexion;
    }

    // Obtén el correo electrónico enviado desde la solicitud AJAX
    $correo = $_POST['correo'];
    $pass = md5($_POST["pass"]);

    // Realiza la consulta para verificar si el correo ya existe
    $conexion = conectar(); // Asegúrate de llamar a la función conectar

    $sql = "SELECT * FROM lista_empleados WHERE correo = '$correo' AND pass='$pass' AND status=1 AND eliminado=0 ";
    $res=$conexion->query($sql);
    $num= $res-> num_rows;
    
    if ($num==1){
        $row = $res->fetch_array();
        $id = $row['id'];
        $usuario = $row['nombre'] . ' ' . $row['apellidos'];
        $correo = $row['correo'];
        
        $_SESSION['id'] = $id;
        $_SESSION['usuario'] = $usuario;
        $_SESSION['correo'] = $correo;
        if($_SESSION['id'] == '1'){
            $_SESSION['tipo']='ADMIN';
            $res=1;
            echo 1;

        }
        else{
            $_SESSION['tipo']='usuario';
            $res=2;
            echo 2;

        }


    }
    
    else{
        echo 0;
    }

?>