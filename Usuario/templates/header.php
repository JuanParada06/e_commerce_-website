<header>
        <h1><a href="../bienvenido.php"><img src="../archivos/logo.png"" alt="LOGO"></a></h1>
        <nav>
            <a href="../bienvenido.php">Inicio</a>
            <a href="../productos.php"> Productos</a>
            <a href="usuario_carrito.php"> Carrito </a>

            <?php 
                if($usuario){
            ?>
            <a href="usuario_detalles.php"> <?=$usuario; ?> </a>
            <a href="../cerrar.php"> Cerrar Sesion </a>

            <?php
                }
                else{
            ?>
                <a href="index1.php"> Iniciar Sesion </a>
            <?php
                }
            ?>

        </nav>
</header>