<?php
    require "./config/conexion.php";

    // Recoge categoria_id de la URL. Si no existe, utiliza una cadena vacía.
    $categoria_id = $_GET["categoria_id"] ?? "";
    // Si el valor es numérico, lo convierte a entero; si no, anula el filtro.
    $categoria_id = is_numeric($categoria_id) ? (int)$categoria_id : "";

    // Obtiene las categorías para construir el selector o menú de filtros.
    $sql_categorias = "
        select id, nombre
        from categorias
        order by nombre";
    $categorias = $conexion->query($sql_categorias);

    // Si se ha seleccionado una categoría, consulta solamente sus productos.
    if($categoria_id != ""){
        // El signo ? es el parámetro que recibirá el identificador de categoría.
        $sql = "
            select p.id, p.nombre, p.precio, p.stock, p.imagen,
            c.nombre as categoria, e.nombre as editorial, ep.nombre as estado
            from productos p inner join categorias c on p.categoria_id = c.id
            inner join editoriales as e on p.editorial_id = e.id
            inner join estados_producto as ep on p.estado_id = ep.id
            where p.categoria_id = ?  
            order by p.nombre";
        
        // Prepara la consulta para introducir el dato de forma segura.
        $stmt = $conexion->prepare($sql);
        // "i" indica que categoria_id se enviará como un número entero.
        $stmt->bind_param("i", $categoria_id);
        // Ejecuta la consulta preparada.
        $stmt->execute();
        // Recupera el resultado para poder recorrerlo con fetch_assoc().
        $productos = $stmt->get_result();
    }else{
        // Si no existe un filtro, obtiene todos los productos.
        $sql = "
            select p.id, p.nombre, p.precio, p.stock, p.imagen,
            c.nombre as categoria, e.nombre as editorial,
            ep.nombre as estado
            from productos p inner join categorias c on p.categoria_id = c.id
            inner join editoriales e on p.editorial_id = e.id
            inner join estados_producto ep on p.estado_id = ep.id
            order by p.nombre";
        $productos = $conexion->query($sql);
    }
?>

<!DOCTYPE html>
<html lang="en">
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
        <a href="./novedades.php">Novedades</a>
        <a href="./contacto.php">Contacto</a>
        <a href="./exportar_csv.php">CSV</a>
    </nav>
    <main>
        <section>
            <h2>Filtro de Categorías</h2>
            <form action="" method="get" class="filtro">
                <label for="categoria_id">Filtrar por categoría</label>
                <select name="categoria_id" id="categoría_id">
                    <option value="">Todas las categorías</option>
                    <?php while($cat = $categorias->fetch_assoc()){ ?>
                        <option value="<?php echo $cat["id"]; ?>"
                            <?php if($categoria_id == $cat["id"]) echo "selected"; ?>>
                            <?php echo htmlspecialchars($cat["nombre"]) ?>
                        </option>
                    <?php } ?>
                </select>
                <button type="submit">Filtrar</button>
            </form>
        </section>
        <section class="grid-productos">
            <?php if($productos && $productos->num_rows > 0){ ?>
                <?php while($producto = $productos->fetch_assoc()){ ?>
                    <?php 
                        $imagen = $producto["imagen"] != "" ? $producto["imagen"] : "sin-imagen.jpg";
                    ?>
                    <article class="tarjeta">
                        <img src="./assets/img/productos/<?php echo htmlspecialchars($imagen) ?>" alt="Imagen de <?php echo htmlspecialchars($producto["nombre"]); ?>">

                        <h2><?php echo htmlspecialchars($producto["nombre"]); ?></h2>
                        <p><strong>Categoría: </strong><?php echo htmlspecialchars($producto["categoria"]); ?></p>
                        <p><strong>Editorial/Proveedor: </strong><?php echo htmlspecialchars($producto["editorial"]); ?></p>
                        <p><strong>Estado: </strong><?php echo htmlspecialchars($producto["estado"]); ?></p>
                        <p><strong>Precio: </strong><?php echo $producto["precio"]; ?></p>
                        <p><strong>Stock: </strong><?php echo $producto["stock"]; ?></p>
                        
                        <a class="boton" href="./detalle.php?id=<?php echo $producto["id"]; ?>">Ver detalle</a>
                    </article>
                <?php } ?>
            <?php }else{ ?>
                <p class="aviso">No hay productos para mostrar.</p>
            <?php } ?>              
        </section>
    </main>
</body>
</html>