<?php
    require "./config/conexion.php";

    $sql = "
        select p.id, p.nombre, p.precio, p.stock, p.imagen, c.nombre as categoria, ep.nombre as estado
        from productos p inner join categorias c on p.categoria_id = c.id
        inner join estados_producto ep on p.estado_id = ep.id
        where p.stock <= 5
        order by p.stock asc, p.nombre asc";

    $stock = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Bajo</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/styles-productos.css">
</head>
<body>
    <header>
        <h1>Productos con Stock Bajo</h1>
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
            <h2>Productos con un stock bajo</h2>
            <div class="grid-productos">
                <?php if($stock && $stock->num_rows > 0){ ?>
                    <?php while($producto = $stock->fetch_assoc()){
                        $imagen = $producto["imagen"] != "" ? $producto["imagen"] : "sin-imagen.jpg"; ?>
                        <article class="tarjeta">
                            <img src="./assets/img/productos/<?php echo htmlspecialchars($imagen); ?>" alt="Imagen de <?php echo htmlspecialchars($producto["nombre"]); ?>">
                            <h2><?php echo htmlspecialchars($producto["nombre"]); ?></h2>
                            <p><strong>Categoria: </strong><?php echo htmlspecialchars($producto["categoria"]); ?></p>
                            <p><strong>Estado: </strong><?php echo htmlspecialchars($producto["estado"]); ?></p>
                            <p><strong>Precio: </strong><?php echo htmlspecialchars($producto["precio"]); ?> &euro;</p>
                            <p><strong>Stock: </strong><?php echo htmlspecialchars($producto["stock"]); ?></p>
                            <a class="boton" href="./detalle.php?id=<?php echo $producto["id"]; ?>">Ver detalle</a>
                        </article>
                    <?php } ?>
                <?php }else{ ?>
                    <p class="aviso">No tenemos productos sin stock bajo, somos unos fieras.</p>
                <?php } ?>
            </div>
        </section>
    </main>
    <footer>
        <p>Tienda Friki Web - Proyecto PHP y MariaDB</p>
    </footer>
</body>
</html>
