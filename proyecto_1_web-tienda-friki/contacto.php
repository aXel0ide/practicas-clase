<?php
    require "./config/conexion.php";

    $mensaje_ok = null;
    $errores = [];

    $sql_productos = "
        select id, nombre
        from productos
        order by nombre";
    
    $productos = $conexion->query($sql_productos);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nombre = trim($_POST["nombre"] ?? "");
        $email = trim($_POST["email"] ?? "");
        $producto_id = $_POST["producto_id"] ?? "";
        $mensaje = trim($_POST["mensaje"] ?? "");

        if($nombre == ""){
            $errores[] = "El nombre es obligatorio.";
        }
        if($email == ""){
            $errores[] = "El email es obligatorio.";
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errores[] = "El email no tiene un formato válido.";
        }

        if($mensaje == ""){
            $errores[] = "El mensaje es obligatorio";
        }
    }

    if(empty($errores)){
        if(is_numeric($producto_id)){
            $producto_id = (int)$producto_id;

            $sql_insert = "
                insert into consultas
                (nombre_cliente, email, producto_id, mensaje, fecha) values
                (?, ?, ?, ?, now())";

            $stmt = $conexion->prepare($sql_insert);
            $stmt->bind_param("ssis", $nombre, $email, $producto_id, $mensaje);
            // ssis indica el tipo de dato de cada valor. s -> string, i-> integer
        }else{
            $sql_insert = "
                insert into consultas
                (nombre_cliente, email, producto_id, mensaje, fecha) values
                (?, ?, null, ?, now())";

            $stmt = $conexion->prepare($sql_insert);
            $stmt->bind_param("sss", $nombre, $email, $mensaje);
        }

        if($stmt->execute()){
            $mensaje_ok = "Consulta guardada correctamente.";
        }else{
            $errores[] = "No se ha podido guardar la consulta";
        }
    }
?>