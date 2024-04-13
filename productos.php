<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <link rel="stylesheet" href="css/style_productos.css">
</head>

<body>
    <?php 
    include('Sesion.php');
    include('templates/header_usuario.php');
    include("conexion.php");

    $conexion = conectar();

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $search_title = $_POST["search_title"];
        $sql = "SELECT * FROM productos WHERE status = 1 AND eliminado = 0 AND nombre LIKE '%$search_title%'";
    } else {
        $order_by = '';
        $order_link = 'Ordenar';
        if (isset($_GET['order']) && $_GET['order'] === 'stock') {
            $order_by = 'stock ASC,';
            $order_link = 'Ordenar';
        }
        $sql = "SELECT * FROM productos WHERE status = 1 AND eliminado = 0 ORDER BY $order_by nombre ASC";
    }

    $res = $conexion->query($sql);
    ?>

    <div class="productos">
        <form class="search-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" id="search_title" name="search_title" placeholder="Buscar Titulo">
            <input type="submit" value="buscar">
            <a href="<?php echo isset($_GET['order']) && $_GET['order'] === 'stock' ? '?order=reset' : '?order=stock'; ?>"><?php echo $order_link; ?></a>
        </form>

        <?php
        if ($res->num_rows > 0) {
            echo "<table>";
            $contador = 0;

            while ($row = $res->fetch_assoc()) {
                $id = $row['id'];
                $autor = $row['autor'];
                $nombre = $row['nombre'];
                $costo = $row['costo'];
                $archivo_producto = $row['archivo_n'];

                // Verificar si el archivo está disponible
                if (!empty($archivo_producto)) {
                    // Abrir una nueva fila después de mostrar 3 productos
                    if ($contador % 3 == 0) {
                        echo "<tr>";
                    }
        ?>
                    <td>
                        <a href="ver_producto.php?id=<?php echo $id; ?>&autor=<?php echo $autor; ?>">
                            <img src="archivos/<?php echo $archivo_producto ?>" alt="Descripción de la imagen"><br><br>
                            <label for=""><?php echo $nombre ?></label><br>
                            <label for="">Precio: <?php echo $costo ?>$</label>
                        </a>
                    </td>
        <?php
                    $contador++;

                    // Cerrar la fila después de mostrar 3 productos
                    if ($contador % 3 == 0) {
                        echo "</tr>";
                    }
                }
            }

            // Rellenar con celdas vacías si no hay un múltiplo de 3 productos en la última fila
            if ($contador % 3 != 0) {
                $celdas_vacias = 3 - ($contador % 3);
                for ($i = 0; $i < $celdas_vacias; $i++) {
                    echo "<td></td>";
                }
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No hay productos disponibles.";
        }
        ?>
    </div>
    <?php
    include("templates/footer.php")
    ?>
</body>
</html>
