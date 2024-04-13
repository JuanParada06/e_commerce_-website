<html>
<head>
    <title>Detalles del Producto</title>
    <?php 
        include("Usuario/funciones/conexion.php");
        include('Sesion.php');

        $conexion = conectar();
    ?>
    <script src="js/jquery-3.3.1.min.js" ></script>
    <link rel="stylesheet" href="css/style_detalles.css">
    <script>
        function valida() {
            var cantidad = document.getElementById('cantidad').value;
            if (cantidad === "0") {
                alert("Selecciona una cantidad válida");
                return false;
            } else {
                return true;
            }
        }
    </script>
</head>
<body>
    <?php include('templates/header_usuario.php');?>

    <?php
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $autor = isset($_GET['autor']) ? $_GET['autor'] : null;

    $sql = "SELECT * FROM productos WHERE id = '$id' AND status = 1 AND eliminado = 0";

    $res=$conexion->query($sql);
    $num= $res->num_rows;

    if ($num===1){
        $row         =      $res->fetch_array();
        $nombre      =      $row['nombre'];
        $codigo      =      $row['codigo'];
        $descripcion =      $row['descripcion'];
        $costo       =      $row['costo'];
        $stock       =      $row['stock'];
        $archivo_n     =      $row['archivo_n'];
    }
    ?>
    <table class="formula">

    <tr>
        <td>
        <form name="formulario" class="forma" method="post" action="pedidos.php" onsubmit="return valida()">
            <h2>Detalles del Producto</h2>
    
            <input type="hidden" name="id"      value="<?php echo $id;    ?>">
            <input type="hidden" name="stock"   value="<?php echo $stock; ?>">
            <input type="hidden" name="costo"   value="<?php echo $costo; ?>">
    
            <div><img src="archivos/<?php echo $archivo_n?>" alt="Descripción de la imagen" width="50px" height="50px"><div>
            <label>Nombre: <?php echo $nombre?></label><br>
            <label>Codigo: <?php echo $codigo; ?></label><br>
            <label>Descripcion: <?php echo $descripcion; ?></label><br>
            <label>Costo: <?php echo $costo; ?> $</label><br>
            
            <label>Cantidad: 
                <select name="cantidad" id="cantidad">
                    <option value="1">1</option>
                    <?php
                    for ($i = 1; $i <= $stock; $i++) {
                        echo "<option value=\"$i\">$i</option>";
                    }
                    ?>
                </select>
            </label><br>
                
            <input type="submit" value="Comprar"><br>
            <a href="bienvenido.php">Regresar</a>
        </form>
        </td>
        <td>
        <table class="relacionado">
    <tr>
        <td><label for="">Productos Relacionados</label></td>
    </tr>
    <?php
    $contador = 0;

    // Suponiendo que '$autor' ya está definido con el autor específico
    $sql = "SELECT * FROM productos WHERE autor = '$autor' AND status = 1 AND eliminado = 0 ORDER BY RAND() LIMIT 3";
    $res = $conexion->query($sql);

    if ($res->num_rows >= 2) {
        echo "<table>";
        $contador = 0;

        while ($row = $res->fetch_assoc()) {
            $id = $row['id'];
            $nombre = $row['nombre'];
            $costo = $row['costo'];
            $archivo_producto = $row['archivo_n'];
            $stock = $row['stock'];

            // Comienza una nueva fila en cada iteración
            echo "<tr>";

            // Muestra el producto
            ?>
            <td class="borde">
                <form name="" method="post" action="pedidos.php" onsubmit="return valida()">
                    <input type="hidden" name="id"      value="<?php echo $id;    ?>">
                    <input type="hidden" name="stock"   value="<?php echo $stock; ?>">
                    <input type="hidden" name="costo"   value="<?php echo $costo; ?>">
                    <input type="hidden" name="cantidad"   value="1">

                    <a href="ver_producto.php?id=<?php echo $id; ?>&autor=<?php echo $autor; ?>">
                    <img src="archivos/<?php echo $archivo_producto ?>" alt="Descripción de la imagen"><br>
                    <label for=""> <?php echo $nombre ?></label>
                    <label for="">Precio: <?php echo $costo ?>$</label>
                    </a>

                    <input type="submit" value="Comprar"><br><br>
                </form>
            </td>
            <?php

            $contador++;
        }

        // Rellena con celdas vacías si no se muestran 3 productos
        for ($i = $contador; $i < 3; $i++) {
            echo "<td></td>";
        }

        echo "</tr></table>";
    } else {
        $sql = "SELECT * FROM productos WHERE  status = 1 AND eliminado = 0 ORDER BY RAND() LIMIT 3";
        $res = $conexion->query($sql);
    
        if ($res->num_rows > 0) {
            echo "<table>";
            $contador = 0;
    
            while ($row = $res->fetch_assoc()) {
                $id = $row['id'];
                $nombre = $row['nombre'];
                $costo = $row['costo'];
                $archivo_producto = $row['archivo_n'];
                $stock = $row['stock'];
    
                // Comienza una nueva fila en cada iteración
                echo "<tr>";
    
                // Muestra el producto
                ?>
                <td class="borde">
                <form name="" method="post" action="pedidos.php" onsubmit="return valida()">
                    <input type="hidden" name="id"      value="<?php echo $id;    ?>">
                    <input type="hidden" name="stock"   value="<?php echo $stock; ?>">
                    <input type="hidden" name="costo"   value="<?php echo $costo; ?>">
                    <input type="hidden" name="cantidad"   value="1">

                    <a href="ver_producto.php?id=<?php echo $id; ?>&autor=<?php echo $autor; ?>">
                    <img src="archivos/<?php echo $archivo_producto ?>" alt="Descripción de la imagen"><br>
                    <label for=""> <?php echo $nombre ?></label>
                    <label for="">Precio: <?php echo $costo ?>$</label>
                    </a>

                    <input type="submit" value="Comprar"><br><br>
                </form>
                </td>
                <?php
    
                $contador++;
            }
    
            // Rellena con celdas vacías si no se muestran 3 productos
            for ($i = $contador; $i < 3; $i++) {
                echo "<td></td>";
            }
    
            echo "</tr></table>";
    }   }
    ?>
</table>
        </td>
        </tr>
    </table>
    <footer>
        <p>mipagina.como |   Todos los derechos reservados  |  Politica de Privadidad |  Terminos y condiciones	|<a href="contacto.php">Contacto</a></p>
    </footer>

</body>

</html>
