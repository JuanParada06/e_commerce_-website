<?php
    include("Sesion.php");

    // Definir variables para los campos del formulario
    $nombre = $email = $asunto = $mensaje = "";
    $nombreErr = $emailErr = $asuntoErr = $mensajeErr = "";
    $enviado = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validar el campo de nombre
        if (empty($_POST["nombre"])) {
            $nombreErr = "El nombre es requerido";
        } else {
            $nombre = test_input($_POST["nombre"]);
        }

        // Validar el campo de correo electrónico
        if (empty($_POST["email"])) {
            $emailErr = "El correo electrónico es requerido";
        } else {
            $email = test_input($_POST["email"]);
            // Validar el formato del correo electrónico
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Formato de correo electrónico inválido";
            }
        }

        // Validar el campo de asunto
        if (empty($_POST["asunto"])) {
            $asuntoErr = "El asunto es requerido";
        } else {
            $asunto = test_input($_POST["asunto"]);
        }

        // Validar el campo de mensaje
        if (empty($_POST["mensaje"])) {
            $mensajeErr = "El mensaje es requerido";
        } else {
            $mensaje = test_input($_POST["mensaje"]);
        }

        // Si no hay errores, enviar el correo electrónico
        if (empty($nombreErr) && empty($emailErr) && empty($asuntoErr) && empty($mensajeErr)) {
            ini_set("SMTP", "tu_servidor_smtp");
            ini_set("smtp_port", "tu_puerto_smtp");
        
            $destinatario = "juan2parada0b@gmail.com"; // Cambia esto al correo electrónico de destino real
            $cabeceras = "From: $email" . "\r\n" .
                          "Reply-To: $email" . "\r\n" .
                          "X-Mailer: PHP/" . phpversion();
        
            // Construir el cuerpo del mensaje
            $cuerpoMensaje = "Nombre: $nombre\n";
            $cuerpoMensaje .= "Correo Electrónico: $email\n";
            $cuerpoMensaje .= "Asunto: $asunto\n";
            $cuerpoMensaje .= "Mensaje:\n$mensaje";
        
            // Enviar el correo electrónico
            mail($destinatario, $asunto, $cuerpoMensaje, $cabeceras);
        
            // Marcar como enviado
            $enviado = true;
        }
    }

    // Función para limpiar y validar los datos del formulario
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style_contacto.css">
    <title>Contacto</title>
</head>
<body>
    <?php include("templates/header_usuario.php")?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre;?>">
        <span class="error"><?php echo $nombreErr;?></span>

        <label for="email">Correo Electrónico:</label>
        <input type="text" id="email" name="email" value="<?php echo $email;?>">
        <span class="error"><?php echo $emailErr;?></span>

        <label for="asunto">Asunto:</label>
        <input type="text" id="asunto" name="asunto" value="<?php echo $asunto;?>">
        <span class="error"><?php echo $asuntoErr;?></span>

        <label for="mensaje">Mensaje:</label>
        <textarea id="mensaje" name="mensaje" rows="4"><?php echo $mensaje;?></textarea>
        <span class="error"><?php echo $mensajeErr;?></span>

        <input type="submit" value="Enviar">
    </form>

    <?php
        if ($enviado) {
            echo "<p>¡El correo electrónico ha sido enviado con éxito!</p>";
        }
    ?>

    <?php include("templates/footer.php")?>
</body>
</html>
