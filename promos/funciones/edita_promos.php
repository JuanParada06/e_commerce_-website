<?php
    include("conexion.php");
    $id=$_POST["id"];
    $nombre = $_POST["nombre"];

    // Conectar a la base de datos
    $conexion = conectar();
    $sql = "SELECT * FROM promociones";
    $result = mysqli_query($conexion, $sql); // Usa la conexión para ejecutar la consulta

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
    if ($conexion) {
        if ($file_name == "") {
            $sql = "UPDATE promociones SET nombre ='".$nombre."' WHERE id='".$id."'";
        } else {
            $sql = "UPDATE promociones SET nombre ='".$nombre."', archivo='".$fileName1."' WHERE id='".$id."'";
        }

        $resultado = mysqli_query($conexion, $sql);
        if (!$resultado) {
            die("Error al ejecutar la consulta: " . mysqli_error($conexion));
        }

        echo "Datos de usuario actualizados con éxito";
        header("Location: ../promos_lista.php");
    } else {
        echo "Error al conectar a la base de datos";
    }

    mysqli_close($conexion);
?>