<?php
    include("conexion.php");
    $id= $_POST["id"];
    $nombre = $_POST["nombre"];
    $autor = $_POST["autor"];
    $descripcion = $_POST["descripcion"];
    $codigo = $_POST["codigo"];
    $stock = $_POST["stock"];
    $costo = $_POST["costo"];

    // Conectar a la base de datos
    $conexion = conectar();
    $sql = "SELECT * FROM productos";
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
        if ($_POST["codigo"] == "" && $file_name == "") {
            $sql = "UPDATE productos SET nombre ='".$nombre."', descripcion ='".$descripcion."', costo='".$costo."', autor='".$autor."', stock='".$stock."' WHERE id='".$id."'";
        } elseif ($_POST["codigo"] != "" && $file_name == "") {
            $sql = "UPDATE productos SET nombre ='".$nombre."', descripcion ='".$descripcion."', costo='".$costo."', autor='".$autor."', codigo='".$codigo."', stock='".$stock."' WHERE id='".$id."'";
        } elseif ($_POST["codigo"] == "" && $file_name != "") {
            $sql = "UPDATE productos SET nombre ='".$nombre."', descripcion ='".$descripcion."', costo='".$costo."', autor='".$autor."', stock='".$stock."', archivo='".$file_name."', archivo_n='".$fileName1."' WHERE id='".$id."'";
        } elseif ($_POST["codigo"] != "" && $file_name != "") {
            $sql = "UPDATE productos SET nombre ='".$nombre."', descripcion ='".$descripcion."', costo='".$costo."', autor='".$autor."', codigo='".$codigo."', stock='".$stock."', archivo='".$file_name."', archivo_n='".$fileName1."' WHERE id='".$id."'";
        } else {
            echo "Error: No se pudo determinar la acción a realizar.";
        }

        if (mysqli_query($conexion, $sql)) {
            echo "Datos de usuario actualizados con éxito";
            header("Location: ../productos_lista.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
        }
    } else {
        echo "Error al conectar a la base de datos";
    }
    
?>
