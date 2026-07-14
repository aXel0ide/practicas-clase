<?php
    require "./config/conexion.php";

    $sql = "
        select p.nombre, p.precio, p.stock, c.nombre as categoria, ep.nombre as estado 
        from productos p inner join categorias c on p.categoria_id = c.id
        inner join estados_producto ep on p.estado_id = ep.id limit 8";

    $resultado = $conexion->query($sql)
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba de Conexion</title>
</head>
<body>
    <h1>Prueba de Conexion con MariaDB</h1>
    <?php if($resultado && $resultado->num_rows > 0){ ?>
        <?php while($fila = $resultado->fetch_assoc()){ ?>
           <p>
                <?php echo htmlspecialchars($fila["nombre"]); ?>,
                <?php echo htmlspecialchars_decode($fila["categoria"]); ?>,
                <?php echo $fila["precio"]; ?> € - 
                Stock: <?php echo $fila["stock"]; ?>
                Estado: <?php echo htmlspecialchars($fila["estado"]) ?>
            </p>
        <?php } ?>
    <?php }else{ ?>
        <p>No se han encontrado productos.</p>
    <?php } ?>
</body>
</html>