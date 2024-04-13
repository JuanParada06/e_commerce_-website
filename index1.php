<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="css/style_login.css">
    <script>
        function validar() {
            var pass = $('#pass').val();
            var correo = $('#correo').val();

            if (correo === "" || pass === "") {
                $('#mensaje').show().html('Faltan campos por llenar');
                setTimeout(function() {
                    $('#mensaje').html('').hide();
                }, 5000);
            } else {
                $.ajax({
                    url: 'validarUser.php',
                    type: 'post',
                    dataType: 'text',
                    data: {
                        correo: correo,
                        pass: pass
                    },
                    success: function(res) {
                        console.log(res);
                        if (res == 1) {
                            window.location.href = 'Inicio.php';
                        } else if (res == 2) {
                            window.location.href = 'bienvenido.php';
                        } else {
                            alert('Usuario no válido');
                        }
                    },
                    error: function() {
                        alert('Error al conectar');
                    }
                });
            }
            return false;
        }
    </script>
</head>
<body>
    
    <form name="Forma01" id="Forma01" method="post">
        <label>Correo: </label>
        <input type="email" name="correo" id="correo" value="@"><br>
        <label>Contraseña: </label>
        <input type="password" name="pass" id="pass" placeholder="Escribe tu password"><br>
        <input type="submit" onclick="return validar();" value="Iniciar Sesion">
        <div id="mensaje"></div>
    </form>
</body>
</html>
