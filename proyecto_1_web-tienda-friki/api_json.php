<?php
    require "./config/conexion.php";
    header("Content-Type: application/json; charset=UTF-8");

    $categoria_id = $_GET["categoria_id"] ?? "";
    $categoria_id = is_numeric($categoria_id) ? (int)$categoria_id : "";

    $base_sql = "
        select p.id, p.nombre, p.descripcion, p.precio, p.stock, p.imagen,
        c.nombre as categoria, e.nombre as editorial, ep.nombre as estado
        from productos p inner join categorias c on p.categoria_id = c.id
        inner join editoriales e on p.editorial_id = e.id
        inner join estados_producto ep on p.estado_id = ep.id";
    
    if($categoria_id != ""){
        $sql = $base_sql . " where p.categoria_id = ? order by p.nombre";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $categoria_id);
        $stmt->execute();
        $resultado = $stmt->get_result();
    }else{
        $sql = $base_sql . " order by p.nombre";
        $resultado = $conexion->query($sql);
    }

    $datos = [];

    if($resultado){
        while($fila = $resultado->fetch_assoc()){
            $datos[] = $fila;
        }
    }

    $respuesta = [
        "estado" => "ok",
        "total" => count($datos),
        "datos" => $datos
    ];

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>
