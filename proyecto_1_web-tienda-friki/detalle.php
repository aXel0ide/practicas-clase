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

        if($resultado && $resultado->num_rows > 1){
            $producto = $resultado->fetch_assoc();
        }else{
            $error = "No se ha encontrado el producto solicitado.";
        }
    }
?>