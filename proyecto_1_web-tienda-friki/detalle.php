<?php
    require "./config/conexion.php";

    $producto = null;
    $datos_videojuego = null;
    $error = null;

    $id = $_GET["id"] ?? "";

    if($id == "" || !is_numeric($id)){
        $error = "Producto no valido";
    }else{
        $id = (int)$id;

        $sql = "
        select p.id, p.nombre, p.descripcion, p.precio, p.stock, p.imagen,
        c.nombre as categoria, e.nombre as editorial, ep.nombre as estado
        from productos p inner join categorias c on p.categoria_id = c.id
        inner join editoriales e on p.editorial_id = e.id
        inner join estados_producto ep on p.estado_id = ep.id
        where p.id = ?";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if($resultado && $resultado->num_rows === 1){
            $producto = $resultado->fetch_assoc();

            $sql_videojuego = "
                select pv.nombre as plataforma, gv.nombre as genero, v.pegi,
                v.desarrolladora, v.anio_lanzamiento, v.formato, v.multijugador
                from videojuegos v
                inner join plataformas_videojuego pv on v.plataforma_id = pv.id
                inner join generos_videojuego gv on v.genero_id = gv.id
                where v.producto_id = ?";

            $stmt_video = $conexion->prepare($sql_videojuego);
            $stmt_video->bind_param("i", $id);
            $stmt_video->execute();
            $res_video = $stmt_video->get_result();
            $datos_videojuego = $res_video->fetch_assoc();
        }else{
            $error = "No se ha encontrado el producto solicitado.";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha Detallada</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/styles-detalle.css">
</head>
<body>
    <header>
        <h1>Ficha Detallada</h1>
    </header>
    <nav>
        <a href="./index.php">Inicio</a>
        <a href="./productos.php">Productos</a>
        <a href="./videojuegos.php">Videojuegos</a>
        <a href="./novedades.php">Novedades</a>
        <a href="./contacto.php">Contacto</a>
    </nav>
    <main>
        <?php if(isset($error)){ ?>
            <p class="error" role="alert"><?php echo htmlspecialchars($error); ?></p>
            <a class="boton" href="./productos.php">Volver al catalogo</a>
        <?php }else{ ?>
            <?php $imagen = $producto["imagen"] != "" ? $producto["imagen"] : "sin-imagen.jpg"; ?>
            <article class="detalle-producto">
                <div>
                    <img class="detalle-img" src="./assets/img/productos/<?php echo htmlspecialchars($imagen); ?>" alt="Imagen de <?php echo htmlspecialchars($producto["nombre"]); ?>">
                </div>
                <div>
                    <h2><?php echo htmlspecialchars($producto["nombre"]); ?></h2>
                    <p><?php echo htmlspecialchars($producto["descripcion"]); ?></p>

                    <ul class="datos-producto">
                        <li><strong>Categoria: </strong> <?php echo htmlspecialchars($producto["categoria"]); ?></li>
                        <li><strong>Editorial/Proveedor: </strong><?php echo htmlspecialchars($producto["editorial"]); ?></li>
                        <li><strong>Estado: </strong><?php echo htmlspecialchars($producto["estado"]); ?></li>
                        <li><strong>Precio: </strong><?php echo htmlspecialchars($producto["precio"]); ?> &euro;</li>
                    </ul>

                    <?php if($datos_videojuego){ ?>
                        <section class="bloque-videojuego">
                            <h2>Datos del videojuego</h2>
                            <ul>
                                <li><strong>Plataforma:</strong> <?php echo htmlspecialchars($datos_videojuego["plataforma"]); ?></li>
                                <li><strong>Genero:</strong> <?php echo htmlspecialchars($datos_videojuego["genero"]); ?></li>
                                <li><strong>PEGI:</strong> <?php echo htmlspecialchars($datos_videojuego["pegi"]); ?></li>
                                <li><strong>Desarrolladora:</strong> <?php echo htmlspecialchars($datos_videojuego["desarrolladora"]); ?></li>
                                <li><strong>Año:</strong> <?php echo htmlspecialchars($datos_videojuego["anio_lanzamiento"]); ?></li>
                                <li><strong>Formato:</strong> <?php echo htmlspecialchars($datos_videojuego["formato"]); ?></li>
                                <li><strong>Multijugador:</strong> <?php echo $datos_videojuego["multijugador"] ? "Si" : "No"; ?></li>
                            </ul>
                        </section>
                    <?php } ?>

                    <button onclick="return confirmarImpresion() && window.print()">Imprimir ficha/Guardar como PDF</button>

                    <a class="boton-secundario" href="./productos.php">Volver al catalogo</a>
                </div>
            </article>
        <?php } ?>    
    </main>
    <footer>
        <p>Tienda Friki Web - Proyecto PHP y MariaDB</p>
    </footer>
    <script src="./assets/js/script.js"></script>
</body>
</html>
