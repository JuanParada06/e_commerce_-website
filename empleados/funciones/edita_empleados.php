
<?php
    include("conexion.php");

    $id = $_POST['id'];
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $correo = $_POST["correo"];

    $password = $_POST["pass"];
    $pass_encript = md5($password);

    $rol = $_POST["rol"];

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
    $conexion = conectar();

    if ($conexion) {
        if ($_POST["pass"] == "" && $file_name == "") {
            $sql = "UPDATE lista_empleados SET nombre ='".$nombre."', apellidos ='".$apellidos."', correo='".$correo."', rol='".$rol."' WHERE id='".$id."'";
        } 
        
        elseif ($_POST["pass"] != "" && $file_name == "") {
            $sql = "UPDATE lista_empleados SET nombre ='".$nombre."', apellidos ='".$apellidos."', correo='".$correo."', pass='".$pass_encript."', rol='".$rol."' WHERE id='".$id."'";
        } 

        elseif ($_POST["pass"] == "" && $file_name != "") {
            $sql = "UPDATE lista_empleados SET nombre ='".$nombre."', apellidos ='".$apellidos."', correo='".$correo."', rol='".$rol."', archivo='".$file_name."', archivo_n='".$fileName1."' WHERE id='".$id."'";
        } 

        elseif ($_POST["pass"] != "" && $file_name != "") {
            $sql = "UPDATE lista_empleados SET nombre ='".$nombre."', apellidos ='".$apellidos."', correo='".$correo."', pass='".$pass_encript."', rol='".$rol."', archivo='".$file_name."', archivo_n='".$fileName1."' WHERE id='".$id."'";
        } 
        
        
        else {
            echo "Error: No se pudo determinar la acción a realizar.";
        }
        if (mysqli_query($conexion, $sql)) {
            echo "Datos de usuario actualizados con éxito";
            header("Location: ../empleados_lista.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
        }
    } else {
        echo "Error al conectar a la base de datos";
    }
?>
