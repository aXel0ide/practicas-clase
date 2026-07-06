<?php
    require "./config/conexion.php";

    $sql = "
        select p.id, p.nombre, p.precio, p.stock, c.nombre as categoria, e.nombre as editorial, ep.nombre as estado
        from productos p inner join categorias c on p.categoria_id = c.id
        inner join editoriales e on p.editorial_id = e.id
        inner join estados_producto ep on p.estado_id = ep.id
        where p.destacado = 1
        order by p.nombre
        limit 4";

    $destacados = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Friki Web</title>
    <link rel="stylesheet" href="./assets/css/styles-index.css">
</head>
<body>
    <header>
        <h1>Tienda Friki Web</h1>
        <p>Cómics, cine, series, videojuegos y coleccionismo</p>
    </header>
    <nav>
        <a href="./index.php">Inicio</a>
        <a href="./productos.php">Productos</a>
        <a href="./contacto.php">Contacto</a>
        <a href="./api_json.php">JSON</a>
        <a href="./api_xml.php">XML</a>
        <a href="./exportar_csv.php">CSV</a>
    </nav>
    <main>
        <section>
            <h2>Bienvenido a la tienda</h2>
            <p>
                Este proyecto es una tienda-catalogo creada con PHP y MariaDB.
                En esta primera parte se muestra la portada y algunos productos destacados.
            </p>
        </section>
        <section>
            <h2>Productos Destacados</h2>
            <div class="grid-productos">
                <?php if($destacados && $destacados->num_rows >1){ ?>
                    <?php while($producto = $destacados->fetch_assoc()){ ?>
                        <article class="tarjeta">
                            <h3><?php echo htmlspecialchars($producto["nombre"]); ?></h3>
                            <p>Categoria: <?php echo htmlspecialchars($producto["categoria"]); ?></p>
                            <p>Editorial: <?php echo htmlspecialchars($producto["editorial"]); ?></p>
                            <p>Estado: <?php echo htmlspecialchars($producto["estado"]); ?></p>
                            <p>Precio: <?php echo htmlspecialchars($producto["precio"]); ?></p>
                            <p>Stock: <?php echo htmlspecialchars($producto["stock"]); ?></p>
                        </article>
                    <?php } ?>
                <?php }else{ ?>
                    <p>No hay productos destacados.</p>
                <?php } ?>
            </div>
        </section>
    </main>
    <script src="./assets/js/script.js"></script>
</body>
</html>