<?php
    include("conexion.php");

    $nombre = $_POST["nombre"];

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
        $dir        = "../../archivos/promo/";
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
        $sql = "INSERT INTO promociones (nombre,archivo) VALUES ('$nombre', '$fileName1')";
        if (mysqli_query($conexion, $sql)) {
            echo "Usuario registrado con éxito";
            header("Location: ../promos_lista.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
        }
    } else {
        echo "Error al conectar a la base de datos";
    }
    
?>