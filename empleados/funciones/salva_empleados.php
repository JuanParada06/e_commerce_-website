
<?php
    include("conexion.php");

    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $password = $_POST["password"];
    $pass_encript = md5($password);
    $correo = $_POST["correo"];
    $rol = $_POST["rol"];

    // Conectar a la base de datos
    $conexion = conectar();
    $sql = "SELECT * FROM lista_empleados";
    $result = mysqli_query($conexion, $sql); // Usa la conexión para ejecutar la consulta
    while ($mostrar = mysqli_fetch_array($result)) {
        if ($mostrar['correo'] == $correo){
            $correo_existente = true;
            break;
        }
    }

    if (isset($_FILES['archivo'])) {

        $file_name  = $_FILES['archivo']['name'];
        $file_tmp   = $_FILES['archivo']['tmp_name'];
        $arreglo    = explode(".", $file_name);
        $len        = count($arreglo);
        $pos        = $len - 1;
        $ext        = $arreglo[$pos];
        $dir        = "../../archivos/";
        if ($file_name != '') {

        $file_enc   = md5_file($file_tmp);
        echo "file_name: $file_name <br>";
        echo "file_tmp: $file_tmp <br>";
        echo "ext: $ext <br>";
        echo "file_enc: $file_enc <br>";
            $fileName1 = "$file_enc.$ext";
            $destination = $dir . $fileName1;
            if (move_uploaded_file($file_tmp, $destination)) {
        
    }}}
    // Verificar la conexión
    if ($conexion) {
        $sql = "INSERT INTO lista_empleados (nombre, apellidos, correo, pass, rol,archivo,archivo_n) VALUES ('$nombre', '$apellidos', '$correo', '$pass_encript', '$rol','$file_name','$fileName1')";
        if (mysqli_query($conexion, $sql)) {
            echo "Usuario registrado con éxito";
            header("Location: ../empleados_lista.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
        }
    } else {
        echo "Error al conectar a la base de datos";
    }
    
?>