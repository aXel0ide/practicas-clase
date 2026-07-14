<?php
    require "./config/conexion.php";
    header("Content-Type: application/xml; charset=UTF-8");

    $sql = "
        select p.id, p.nombre, p.precio, p.stock, p.imagen,
        c.nombre as categoria, ep.nombre as estado
        from productos p inner join categorias c on p.categoria_id = c.id
        inner join estados_producto ep on p.estado_id = ep.id
        order by p.nombre";
    
    $resultado = $conexion->query($sql);

    echo "<?xml version='1.0' encoding='UTF-8'?>";
    echo "<productos>";

    if($resultado){
        while($fila = $resultado->fetch_assoc()){
            echo "<producto>";
                echo "<id>" . $fila["id"] . "</id>";
                echo "<nombre>" . htmlspecialchars($fila["nombre"]) . "</nombre>";
                echo "<categoria>" . htmlspecialchars($fila["categoria"]) . "</categoria>";
                echo "<precio>" . $fila["precio"] . "</precio>";
                echo "<stock>" . $fila["stock"] . "</stock>";
                echo "<estado>" . htmlspecialchars($fila["estado"]) . "</estado>";
                echo "<imagen>" . htmlspecialchars($fila["imagen"]) . "</imagen>";
            echo "</producto>";
        }
    }

    echo "</productos>";
?>