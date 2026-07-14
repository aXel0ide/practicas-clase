<?php
    require "./config/conexion.php";

    $buscar = trim($_GET["buscar"] ?? "");
    $categoria_id = $_GET["categoria_id"] ?? "";
    $estado_id = $_GET["estado_id"] ?? "";
    $precio_max = $_GET["precio_max"] ?? "";

    $categoria_id = is_numeric($categoria_id) ? (int)$categoria_id : "";
    $estado_id = is_numeric($estado_id) ? (int)$estado_id : "";
    $precio_max = is_numeric($precio_max) ? (float)$precio_max : "";

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
        select p.nombre, p.precio, p.stock,
        c.nombre as categoria, ep.nombre as estado
        from productos p
        inner join categorias c on p.categoria_id = c.id
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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado filtrado de productos</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/styles-pdf.css">
</head>
<body>
    <nav>
        <a href="./index.php">Inicio</a>
        <a href="./productos.php">Productos</a>
        <a href="./videojuegos.php">Videojuegos</a>
        <a href="./novedades.php">Novedades</a>
        <a href="./contacto.php">Contacto</a>
    </nav>
    <main class="pdf-listado">
        <h1>Listado filtrado de productos</h1>
        <p>Proyecto Tienda Friki Web</p>

        <button class="no-imprimir" onclick="window.print()">Guardar como PDF</button>

        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Categoria</th>
                    <th>Estado</th>
                    <th>Precio</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                <?php if($productos && $productos->num_rows > 0){ ?>
                    <?php while($producto = $productos->fetch_assoc()){ ?>
                        <tr>
                            <td><?php echo htmlspecialchars($producto["nombre"]); ?></td>
                            <td><?php echo htmlspecialchars($producto["categoria"]); ?></td>
                            <td><?php echo htmlspecialchars($producto["estado"]); ?></td>
                            <td><?php echo htmlspecialchars($producto["precio"]); ?> &euro;</td>
                            <td><?php echo htmlspecialchars($producto["stock"]); ?></td>
                        </tr>
                    <?php } ?>
                <?php }else{ ?>
                    <tr>
                        <td colspan="5">No hay productos para mostrar.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
    <footer>
        <p>Tienda Friki Web - Proyecto PHP y MariaDB</p>
    </footer>
</body>
</html>
