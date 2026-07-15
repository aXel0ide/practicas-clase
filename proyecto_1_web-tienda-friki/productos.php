<?php
    require "./config/conexion.php";

    $buscar = trim($_GET["buscar"] ?? "");
    $categoria_id = $_GET["categoria_id"] ?? "";
    $estado_id = $_GET["estado_id"] ?? "";
    $precio_max = $_GET["precio_max"] ?? "";

    $categoria_id = is_numeric($categoria_id) ? (int)$categoria_id : "";
    $estado_id = is_numeric($estado_id) ? (int)$estado_id : "";
    $precio_max = is_numeric($precio_max) ? (float)$precio_max : "";

    $categorias = $conexion->query("
        select id, nombre
        from categorias
        order by nombre");

    $estados = $conexion->query("
        select id, nombre
        from estados_producto
        order by nombre");

    $condiciones = [];
    $parametros = [];
    $tipos = "";

    if($buscar != ""){
        $condiciones[] = "(p.nombre like ? or p.descripcion like ?)";
        $parametros[] = "%" . $buscar . "%";
        $parametros[] = "%" . $buscar . "%";
        $tipos .= "ss";
    }

    if($categoria_id != ""){
        $condiciones[] = "p.categoria_id = ?";
        $parametros[] = $categoria_id;
        $tipos .= "i";
    }

    if($estado_id != ""){
        $condiciones[] = "p.estado_id = ?";
        $parametros[] = $estado_id;
        $tipos .= "i";
    }

    if($precio_max != ""){
        $condiciones[] = "p.precio <= ?";
        $parametros[] = $precio_max;
        $tipos .= "d";
    }

    $sql = "
        select p.id, p.nombre, p.descripcion, p.precio, p.stock, p.imagen,
        c.nombre as categoria, e.nombre as editorial, ep.nombre as estado
        from productos p inner join categorias c on p.categoria_id = c.id
        inner join editoriales e on p.editorial_id = e.id
        inner join estados_producto ep on p.estado_id = ep.id";

    if(!empty($condiciones)){
        $sql .= " where " . implode(" and ", $condiciones);
    }

    $sql .= " order by p.nombre";
    $stmt = $conexion->prepare($sql);

    if(!empty($parametros)){
        $stmt->bind_param($tipos, ...$parametros);
    }

    $stmt->execute();
    $productos = $stmt->get_result();

    $query_pdf = http_build_query([
        "buscar" => $buscar,
        "categoria_id" => $categoria_id,
        "estado_id" => $estado_id,
        "precio_max" => $precio_max
    ]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos de Nuestra Tienda</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/styles-productos.css">
</head>
<body>
    <header>
        <h1>Productos</h1>
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
            <h2>Filtros avanzados</h2>
            <form action="" method="get" class="filtro">
                <div class="campo-filtro">
                    <label for="buscar">Buscar</label>
                    <input type="search" name="buscar" id="buscar" value="<?php echo htmlspecialchars($buscar); ?>" placeholder="Nombre o descripcion">
                </div>

                <div class="campo-filtro">
                    <label for="categoria_id">Categoria</label>
                    <select name="categoria_id" id="categoria_id">
                        <option value="">Todas las categorias</option>
                        <?php while($cat = $categorias->fetch_assoc()){ ?>
                            <option value="<?php echo $cat["id"]; ?>" <?php if($categoria_id == $cat["id"]) echo "selected"; ?>>
                                <?php echo htmlspecialchars($cat["nombre"]); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="campo-filtro">
                    <label for="estado_id">Estado</label>
                    <select name="estado_id" id="estado_id">
                        <option value="">Todos los estados</option>
                        <?php while($estado = $estados->fetch_assoc()){ ?>
                            <option value="<?php echo $estado["id"]; ?>" <?php if($estado_id == $estado["id"]) echo "selected"; ?>>
                                <?php echo htmlspecialchars($estado["nombre"]); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="campo-filtro">
                    <label for="precio_max">Precio maximo</label>
                    <input type="number" step="0.01" name="precio_max" id="precio_max" value="<?php echo htmlspecialchars($precio_max); ?>">
                </div>

                <div class="acciones-filtro">
                    <button type="submit">Aplicar filtros</button>
                    <a class="boton-secundario" href="./productos_pdf.php?<?php echo htmlspecialchars($query_pdf); ?>" target="_blank">Guardar esta lista en PDF</a>
                </div>
            </form>
        </section>

        <section class="grid-productos">
            <?php if($productos && $productos->num_rows > 0){ ?>
                <?php while($producto = $productos->fetch_assoc()){ ?>
                    <?php $imagen = $producto["imagen"] != "" ? $producto["imagen"] : "sin-imagen.jpg"; ?>
                    <article class="tarjeta">
                        <img src="./assets/img/productos/<?php echo htmlspecialchars($imagen); ?>" alt="Imagen de <?php echo htmlspecialchars($producto["nombre"]); ?>">
                        <h2><?php echo htmlspecialchars($producto["nombre"]); ?></h2>
                        <p><strong>Categoria: </strong><?php echo htmlspecialchars($producto["categoria"]); ?></p>
                        <p><strong>Editorial/Proveedor: </strong><?php echo htmlspecialchars($producto["editorial"]); ?></p>
                        <p><strong>Estado: </strong><?php echo htmlspecialchars($producto["estado"]); ?></p>
                        <p><strong>Precio: </strong><?php echo htmlspecialchars($producto["precio"]); ?> &euro;</p>
                        <p><strong>Stock: </strong><?php echo htmlspecialchars($producto["stock"]); ?></p>
                        <a class="boton" href="./detalle.php?id=<?php echo $producto["id"]; ?>">Ver detalle</a>
                    </article>
                <?php } ?>
            <?php }else{ ?>
                <p class="aviso">No hay productos para mostrar.</p>
            <?php } ?>              
        </section>
    </main>
    <footer>
        <p>Tienda Friki Web - Proyecto PHP y MariaDB</p>
    </footer>
</body>
</html>
