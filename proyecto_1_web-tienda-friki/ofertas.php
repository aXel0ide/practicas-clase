<?php
    require "./config/conexion.php";

    $sql = "
        select p.id, p.nombre, p.precio, p.stock, p.imagen, c.nombre as categoria, ep.nombre as estado
        from productos p inner join categorias c on p.categoria_id = c.id
        inner join estados_producto ep on p.estado_id = ep.id
        where stock > 0 and p.precio <= 20
        order by p.precio asc";

    $ofertas = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofertas</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/styles-productos.css">
</head>
<body>
    <header>
        <h1>Ofertas de Nuestra Tienda</h1>
    </header>
    <nav>
        <a href="./index.php">Inicio</a>
        <a href="./productos.php">Productos</a>
        <a href="./videojuegos.php">Videojuegos</a>
        <a href="./novedades.php">Novedades</a>
        <a href="./ofertas.php">Ofertas</a>
        <a href="./contacto.php">Contacto</a>
    </nav>
    <main>
        <section>
            <h2>Descubre nuestras ofertas semanales</h2>
            <div class="grid-productos">
                <?php if($ofertas && $ofertas->num_rows > 0){ ?>
                    <?php while($oferta = $ofertas->fetch_assoc()){ ?>
                        <?php $imagen = $oferta["imagen"] != "" ? $oferta["imagen"] : "sin-imagen.jpg"; ?>
                        <article class="tarjeta">
                            <img src="./assets/img/productos/<?php echo htmlspecialchars($imagen); ?>" alt="Imagen de <?php echo htmlspecialchars($oferta["nombre"]); ?>">
                            <h2><?php echo htmlspecialchars($oferta["nombre"]); ?></h2>
                            <p><strong>Categoria: </strong><?php echo htmlspecialchars($oferta["categoria"]); ?></p>
                            <p><strong>Estado: </strong><?php echo htmlspecialchars($oferta["estado"]); ?></p>
                            <p><strong>Precio: </strong><?php echo htmlspecialchars($oferta["precio"]); ?> &euro;</p>
                            <p><strong>Stock: </strong><?php echo htmlspecialchars($oferta["stock"]); ?></p>
                            <a class="boton" href="./detalle.php?id=<?php echo $oferta["id"]; ?>">Ver detalle</a>
                        </article>
                    <?php } ?>
                <?php }else{ ?>
                    <p class="aviso">No existen ofertas actualmente.</p>
                <?php } ?>
            </div>
        </section>
    </main>
    <footer>
        <p>Tienda Friki Web - Proyecto PHP y MariaDB</p>
    </footer>
</body>
</html>
