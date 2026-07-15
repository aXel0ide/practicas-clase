<?php
    require "./config/conexion.php";

    $sql_novedades = "
        select n.producto_id, p.nombre, p.imagen, n.titulo, n.subtitulo,
        n.imagen_banner, n.texto_boton
        from novedades n left join productos p on n.producto_id = p.id
        where n.activo = 1
        order by n.orden asc, n.fecha_inicio desc";
    
    $novedades = $conexion->query($sql_novedades);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novedades en la Tienda</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/styles-novedades.css">
</head>
<body>
    <header>
        <h1>Novedades actuales en la Tienda Friki</h1>
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
        <h2>Ultimas novedades</h2>
        <p>Descubre lanzamientos, colecciones destacadas y propuestas especiales para fans de los videojuegos, el comic y el coleccionismo.</p>

        <section>
            <?php if($novedades && $novedades->num_rows > 0){ ?>
                <?php while($novedad = $novedades->fetch_assoc()){ ?>
                    <?php
                        $tiene_producto = $novedad["producto_id"] != "";
                        $enlace = $tiene_producto ? "./detalle.php?id=" . $novedad["producto_id"] : "./productos.php";
                        $imagen = $tiene_producto && $novedad["imagen"] != "" ? $novedad["imagen"] : $novedad["imagen_banner"];
                        $carpeta = $tiene_producto && $novedad["imagen"] != "" ? "productos" : "novedades";
                    ?>
                    <article class="novedad">
                        <img src="./assets/img/<?php echo $carpeta; ?>/<?php echo htmlspecialchars($imagen); ?>" alt="Imagen de <?php echo htmlspecialchars($novedad["titulo"]); ?>">
                        <h3><?php echo htmlspecialchars($novedad["titulo"]); ?></h3>
                        <p><?php echo htmlspecialchars($novedad["subtitulo"]); ?></p>
                        <?php if($tiene_producto){ ?>
                            <p><strong><?php echo htmlspecialchars($novedad["nombre"]); ?></strong></p>
                        <?php } ?>
                        <a class="boton" href="<?php echo htmlspecialchars($enlace); ?>"><?php echo htmlspecialchars($novedad["texto_boton"]); ?></a>
                    </article>
                <?php } ?>     
            <?php }else{ ?>
                <p class="aviso">No hay novedades para mostrar actualmente.</p>
            <?php } ?>
        </section>
    </main>
    <footer>
        <p>Tienda Friki Web - Proyecto PHP y MariaDB</p>
    </footer>
</body>
</html>
