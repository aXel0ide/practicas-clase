<?php
    require "./config/conexion.php";

    $sql_novedades = "
        select n.producto_id, p.nombre, p.imagen, n.titulo, n.subtitulo, n.texto_boton, n.activo
        from productos p inner join novedades n on p.id = n.producto_id
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
        <a href="./contacto.php">Contacto</a>
        <a href="./exportar_csv.php">CSV</a>
    </nav>
    <main>
        <h2>Ultimas novedades</h2>
        <p>Descubre las últimas novedades de la tienda: </p>
        <section>
            <?php if($novedades && $novedades->num_rows > 0){ ?>
                <?php while($novedad = $novedades->fetch_assoc()){ ?>
                    <?php $enlace = $novedad["producto_id"] != "" ? "./detalle.php?id=" . $novedad["producto_id"] : "./productos.php"; ?>
                    <article class="novedad">
                        <h3><?php echo htmlspecialchars($novedad["titulo"]); ?></h3>
                        <p><?php echo htmlspecialchars($novedad["subtitulo"]); ?></p>
                        <img src="./assets/img/productos/<?php echo htmlspecialchars($novedad["imagen"]); ?>" alt="Imagen de <?php echo htmlspecialchars($novedad["nombre"]); ?>">
                        <p><strong><?php echo htmlspecialchars($novedad["nombre"]); ?></strong></p>
                        <a class="boton" href="<?php echo htmlspecialchars($enlace); ?>"><?php echo htmlspecialchars($novedad["texto_boton"]); ?></a>
                    </article>
                <?php }?>     
            <?php }else{ ?>
                <p class="aviso">No hay novedades para mostrar actualmente.</p>
            <?php } ?>
        </section>
    </main>
</body>
</html>
