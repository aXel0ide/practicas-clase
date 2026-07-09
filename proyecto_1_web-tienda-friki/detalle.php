<?php
    require "./config/conexion.php";

    $id = $_GET["id"] ?? "";

    if($id == "" && !is_numeric($id)){
        $error = "Producto no válido";
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
        }else{
            $error = "No se ha encontrado el producto solicitado.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha Detallada</title>
    <link rel="stylesheet" href="./assets/css/styles-detalle.css">
</head>
<body>
    <header>
        <h1>Ficha Detallada</h1>
    </header>
    <nav>
        <a href="./index.php">Inicio</a>
        <a href="./contacto.php">Contacto</a>
    </nav>
    <main>
        <?php if(isset($error)){ ?>
            <p class="error" role="alert"><?php echo htmlspecialchars($error); ?></p>
            <a class="boton" href="./productos.php">Volver al catálogo</a>
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
                        <li><strong>Categoría: </strong> <?php echo htmlspecialchars($producto["categoria"]); ?></li>
                        <li><strong>Editorial/Proveedor: </strong><?php echo htmlspecialchars($producto["editorial"]); ?></li>
                        <li><strong>Estado: </strong><?php echo htmlspecialchars($producto["estado"]) ?></li>
                        <li><strong>Precio: </strong><?php echo htmlspecialchars($producto["precio"]); ?> €</li>
                    </ul>

                    <button onclick="return confirmarImpresion() && window.print()">Imprimir ficha/Guardar como PDF</button>

                    <a class="boton-secundario" href="./productos.php">Volver al catálogo</a>
                </div>
            </article>
        <?php } ?>    
    </main>
</body>
</html>