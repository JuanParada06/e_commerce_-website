<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <link rel="stylesheet" href="css/style_bienvenido.css">
    <script>
        
        function valida() {
            var cantidad = document.getElementById('cantidad').value;
            if (cantidad === "0") {
                alert("Selecciona una cantidad válida");
                return false;
            }

            // Comprobar si la sesión está activa
            <?php
            if (!isset($_SESSION['usuario'])) {
                echo "alert('Debes iniciar sesión para realizar una compra.'); return false;";
            }
            ?>
        }
    </script>
</head>

<body>
    <?php 
    include('Sesion.php');

    include('templates/header_usuario.php');
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

    $conexion = conectar();

    $sql = "SELECT * FROM promociones";
    $res=$conexion->query($sql);
    $num= $res-> num_rows;
    $bandera = false;
    $id_promo  = rand(1,$num);

    while(!$bandera){
        $sql = "SELECT * FROM promociones WHERE id = '$id_promo' AND status = 1 and eliminado = 0 " ;
        $res=$conexion->query($sql);
        $num= $res-> num_rows;

        if ($num===1){
            $row        =     $res->fetch_array();
            $archivo    =     $row['archivo'];
        }
        if($archivo!=""){
            $bandera = true;
            break;
        }
    }
    ?>
    <div class="marco">
        <div class="banner">
            <img src="archivos/promo/<?php echo $archivo?>" alt="Descripción de la imagen" >
        </div>

        <div class="productos">
    <table>
        <?php
            $contador = 0;
            for ($j = 0; $j < 2; $j++) { // Solo necesitas dos filas ya que cada fila contiene tres productos
                echo "<tr>"; // Inicia una nueva fila en cada iteración

                for ($i = 0; $i < 3; $i++) {
                    $sql = "SELECT * FROM productos WHERE status = 1 AND eliminado = 0 ORDER BY RAND() LIMIT 1";
                    $res = $conexion->query($sql);
                    $num = $res->num_rows;

                    if ($num > 0) {
                        $row = $res->fetch_array();
                        $id = $row['id'];
                        $autor =$row['autor'];
                        $nombre = $row['nombre'];
                        $costo = $row['costo'];
                        $archivo_producto = $row['archivo_n'];

                        ?>
                        <td>
                            <form name="formulario" method="post" action="pedidos.php" onsubmit="return valida()">
                                <input type="hidden" name="id"      value="<?php echo $id;    ?>">
                                <input type="hidden" name="stock"   value="<?php echo $stock; ?>">
                                <input type="hidden" name="costo"   value="<?php echo $costo; ?>">
                                <input type="hidden" name="cantidad"   value="1">
                        
                                <a href="ver_producto.php?id=<?php echo $id; ?>&autor=<?php echo $autor; ?>">
                                    <img src="archivos/<?php echo $archivo_producto; ?>" alt="Descripción de la imagen"><br><br>
                                    <label for=""> <?php echo $nombre; ?></label><br>
                                    <label for="">Precio: <?php echo $costo; ?>$</label>
                                </a>
                                <br>
                                <input type="submit" value="Comprar"><br>
                            </form>
                            
                        </td>
                        <?php
                    } else {
                        // Si no se encuentra ningún producto, mostrar una celda vacía
                        echo "<td></td>";
                    }
                }
                echo "</tr>"; // Cierra la fila después de tres columnas
            }
        ?>
    </table>
</div>
    </div>
<?php
    include("templates/footer.php")
?>
</body>
</html>
