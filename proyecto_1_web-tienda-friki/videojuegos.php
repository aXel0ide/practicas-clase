<?php
    require "./config/conexion.php";

    $buscar = trim($_GET["buscar"] ?? "");
    $plataforma_id = $_GET["plataforma_id"] ?? "";
    $genero_id = $_GET["genero_id"] ?? "";
    $pegi_max = $_GET["pegi_max"] ?? "";
    $precio_max = $_GET["precio_max"] ?? "";

    $plataforma_id = is_numeric($plataforma_id) ? (int)$plataforma_id : "";
    $genero_id = is_numeric($genero_id) ? (int)$genero_id : "";
    $pegi_max = is_numeric($pegi_max) ? (int)$pegi_max : "";
    $precio_max = is_numeric($precio_max) ? (float)$precio_max : "";

    $plataformas = $conexion->query("
        select id, nombre
        from plataformas_videojuego
        order by nombre");

    $generos = $conexion->query("
        select id, nombre
        from generos_videojuego
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

    if($plataforma_id != ""){
        $condiciones[] = "v.plataforma_id = ?";
        $parametros[] = $plataforma_id;
        $tipos .= "i";
    }

    if($genero_id != ""){
        $condiciones[] = "v.genero_id = ?";
        $parametros[] = $genero_id;
        $tipos .= "i";
    }

    if($pegi_max != ""){
        $condiciones[] = "v.pegi <= ?";
        $parametros[] = $pegi_max;
        $tipos .= "i";
    }

    if($precio_max != ""){
        $condiciones[] = "p.precio <= ?";
        $parametros[] = $precio_max;
        $tipos .= "d";
    }

    $sql = "
        select p.id, p.nombre, p.descripcion, p.precio, p.stock, p.imagen,
        pv.nombre as plataforma, gv.nombre as genero, v.pegi, v.desarrolladora,
        v.anio_lanzamiento, v.formato, v.multijugador
        from videojuegos v
        inner join productos p on v.producto_id = p.id
        inner join plataformas_videojuego pv on v.plataforma_id = pv.id
        inner join generos_videojuego gv on v.genero_id = gv.id";

    if(!empty($condiciones)){
        $sql .= " where " . implode(" and ", $condiciones);
    }

    $sql .= " order by p.nombre";
    $stmt = $conexion->prepare($sql);

    if(!empty($parametros)){
        $stmt->bind_param($tipos, ...$parametros);
    }

    $stmt->execute();
    $videojuegos = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videojuegos</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/styles-productos.css">
    <link rel="stylesheet" href="./assets/css/styles-videojuegos.css">
</head>
<body>
    <header>
        <h1>Videojuegos</h1>
        <p>Catalogo especializado por plataforma, genero, PEGI y precio</p>
    </header>
    <nav>
        <a href="./index.php">Inicio</a>
        <a href="./productos.php">Productos</a>
        <a href="./videojuegos.php">Videojuegos</a>
        <a href="./novedades.php">Novedades</a>
        <a href="./contacto.php">Contacto</a>
    </nav>
    <main>
        <section>
            <h2>Filtros de videojuegos</h2>
            <form method="get" class="filtro avanzado" aria-label="Filtros de videojuegos">
                <div class="campo-filtro">
                    <label for="buscar">Buscar</label>
                    <input type="search" name="buscar" id="buscar" value="<?php echo htmlspecialchars($buscar); ?>" placeholder="Nombre o descripcion">
                </div>

                <div class="campo-filtro">
                    <label for="plataforma_id">Plataforma</label>
                    <select name="plataforma_id" id="plataforma_id">
                        <option value="">Todas</option>
                        <?php while($plataforma = $plataformas->fetch_assoc()){ ?>
                            <option value="<?php echo $plataforma["id"]; ?>" <?php if($plataforma_id == $plataforma["id"]) echo "selected"; ?>>
                                <?php echo htmlspecialchars($plataforma["nombre"]); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="campo-filtro">
                    <label for="genero_id">Genero</label>
                    <select name="genero_id" id="genero_id">
                        <option value="">Todos</option>
                        <?php while($genero = $generos->fetch_assoc()){ ?>
                            <option value="<?php echo $genero["id"]; ?>" <?php if($genero_id == $genero["id"]) echo "selected"; ?>>
                                <?php echo htmlspecialchars($genero["nombre"]); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="campo-filtro">
                    <label for="pegi_max">PEGI maximo</label>
                    <input type="number" name="pegi_max" id="pegi_max" min="0" value="<?php echo htmlspecialchars($pegi_max); ?>">
                </div>

                <div class="campo-filtro">
                    <label for="precio_max">Precio maximo</label>
                    <input type="number" step="0.01" name="precio_max" id="precio_max" value="<?php echo htmlspecialchars($precio_max); ?>">
                </div>

                <div class="acciones-filtro">
                    <button type="submit">Aplicar filtros</button>
                </div>
            </form>
        </section>

        <section class="grid-productos">
            <?php if($videojuegos && $videojuegos->num_rows > 0){ ?>
                <?php while($juego = $videojuegos->fetch_assoc()){ ?>
                    <?php $imagen = $juego["imagen"] != "" ? $juego["imagen"] : "sin-imagen.jpg"; ?>
                    <article class="tarjeta videojuego">
                        <img src="./assets/img/productos/<?php echo htmlspecialchars($imagen); ?>" alt="Imagen de <?php echo htmlspecialchars($juego["nombre"]); ?>">
                        <h2><?php echo htmlspecialchars($juego["nombre"]); ?></h2>
                        <p><strong>Plataforma: </strong><?php echo htmlspecialchars($juego["plataforma"]); ?></p>
                        <p><strong>Genero: </strong><?php echo htmlspecialchars($juego["genero"]); ?></p>
                        <p><strong>PEGI: </strong><?php echo htmlspecialchars($juego["pegi"]); ?></p>
                        <p><strong>Desarrolladora: </strong><?php echo htmlspecialchars($juego["desarrolladora"]); ?></p>
                        <p><strong>Año: </strong><?php echo htmlspecialchars($juego["anio_lanzamiento"]); ?></p>
                        <p><strong>Formato: </strong><?php echo htmlspecialchars($juego["formato"]); ?></p>
                        <p><strong>Multijugador: </strong><?php echo $juego["multijugador"] ? "Si" : "No"; ?></p>
                        <p><strong>Precio: </strong><?php echo htmlspecialchars($juego["precio"]); ?> &euro;</p>
                        <p><strong>Stock: </strong><?php echo htmlspecialchars($juego["stock"]); ?></p>
                        <a class="boton" href="./detalle.php?id=<?php echo $juego["id"]; ?>">Ver detalle</a>
                    </article>
                <?php } ?>
            <?php }else{ ?>
                <p class="aviso">No hay videojuegos para mostrar con esos filtros.</p>
            <?php } ?>
        </section>
    </main>
    <footer>
        <p>Tienda Friki Web - Proyecto PHP y MariaDB</p>
    </footer>
</body>
</html>
