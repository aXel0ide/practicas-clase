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

    $sql_novedades = "
        select n.id, n.producto_id, n.titulo, n.subtitulo, n.imagen_banner, n.texto_boton
        from novedades n
        where n.activo = 1
        order by n.orden asc, n.fecha_inicio desc";

    $novedades = $conexion->query($sql_novedades);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Friki Web</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
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
        <a href="./videojuegos.php">Videojuegos</a>
        <a href="./novedades.php">Novedades</a>
        <a href="./ofertas.php">Ofertas</a>
        <a href="./stock_bajo.php">Productos con Stock Bajo</a>
        <a href="./contacto.php">Contacto</a>
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
        <section class="carrusel">
            <h2>Novedades Destacadas</h2>

            <div class="carrusel-contenedor">
                <?php $contador = 0; ?>
                <?php while($nov = $novedades->fetch_assoc()){ ?>
                    <?php 
                        $clase = $contador == 0 ? "slide activo" : "slide";
                        $banner = $nov["imagen_banner"] != "" ? $nov["imagen_banner"] : "banner_generico.jpg";
                        $enlace = $nov["producto_id"] != "" ? "./detalle.php?id=" . $nov["producto_id"] : "novedades.php";
                    ?>

                    <article class="<?php echo $clase; ?>">
                        <img src="./assets/img/novedades/<?php echo htmlspecialchars($banner); ?>" alt="<?php echo htmlspecialchars($nov["titulo"]); ?>">
                        
                        <div class="slide-texto">
                            <h3><?php echo htmlspecialchars($nov["titulo"]); ?></h3>
                            <p><?php echo htmlspecialchars($nov["subtitulo"]); ?></p>
                            <a class="boton" href="<?php echo htmlspecialchars($enlace); ?>"><?php echo htmlspecialchars($nov["texto_boton"]); ?></a>
                        </div>
                    </article>
                    <?php $contador++; ?>
                    <?php } ?>
                    <button class="carrusel-btn anterior" aria-label="Novedad anterior"><</button>
                    <button class="carrusel-btn siguiente" aria-label="Novedad siguiente">></button>
            </div>
        </section>
        <section class="aviso-ofretas">
            <h2>Ofertas frikis de la semana</h2>
            <p>Productos con precio especial y stock disponible.</p>
            <a href="./ofertas.php" class="boton">Ver ofertas</a>
        </section>
        <section class="aviso-stock">
            <h2>Productos con pocas unides</h2>
            <p>Revisa los productos que estan a punto de agotarse.</p>
            <a class="boton" href="./stock_bajo.php">Ver stock bajo</a>
        </section>
    </main>
    <footer>
        <p>Tienda Friki Web - Proyecto PHP y MariaDB</p>
    </footer>
    <script src="./assets/js/script.js"></script>
</body>
</html>
