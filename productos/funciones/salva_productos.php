<?php
    include("conexion.php");

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
    // Verificar la conexión
    if ($conexion) {
        $sql = "INSERT INTO productos (nombre, codigo, descripcion, costo, stock,archivo,archivo_n,autor) VALUES ('$nombre', '$codigo', '$descripcion', '$costo', '$stock','$file_name','$fileName1','$autor')";
        if (mysqli_query($conexion, $sql)) {
            header("Location: ../productos_lista.php");
            echo "Usuario registrado con éxito";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
        }
    } else {
        echo "Error al conectar a la base de datos";
    }
    
?>