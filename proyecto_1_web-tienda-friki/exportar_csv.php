<?php
    require "./config/conexion.php";

    // Lo que va a devolver es un archivo CSV.
    header("Content-Type: text/csv; charset=UTF-8");
    // Dice al navegador que descargue el resultado como archivo con un nombre concreto.
    header("Content-Disposition: attachment; filename=productos_tienda_friki.csv");

    // Crea una función para evitar inyecciones CSV. Algunas hojas de cálculo pueden interpretar
    // valores que empiezan por =,, -, @ como fórmulas.
    function proteger_csv($valor){
        // Convierte el valor recibido a texto.
        $valor = (string)$valor;
        // Comprueba que el  valor no está vacío y que el primer carácter sea =, +, - o @
        if($valor !== "" && in_array($valor[0], ["=", "+", "-", "@"])){
            // Si detecta uno de esos caracteres, le añade una comilla delante.
            // =SUMA(1+1) se convierte en '=SUMA(1+1), de esta forma la hoja de calculo lo trata
            // como texto y no como fórmula.
            return "'" . $valor;
        }

        return $valor;
    }

    // Abre una salida para escribir directamente en la respuesta del navegador.
    $salida = fopen("php://output", "w");

    // Añade BOM UTF-8 para que Excel reconozca bien tildes, ñ y caracteres especiales.
    fputs($salida, "\xEF\xBB\xBF");

    // Escribe la primera fila del CSV, los encabezados.
    fputcsv($salida, [
        "nombre", "descripcion", "precio", "stock", "categoria", "estado", "editorial", "imagen"
    ], ";");

    $sql = "
        select p.nombre, p.descripcion, p.precio, p.stock, p.imagen,
        c.nombre as categoria, ep.nombre as estado, e.nombre as editorial
        from productos p inner join categorias c on p.categoria_id = c.id
        inner join estados_producto ep on p.estado_id = ep.id
        inner join editoriales e on p.editorial_id = e.id
        order by p.nombre";

    $resultado = $conexion->query($sql);

    // Comprueba que la consulta se haya ejecutado correctamente.
    if($resultado){
        // Recorre l.os productos uno a uno, cada fila es una array asociativo con los datos de un producto.
        while($fila = $resultado->fetch_assoc()){
            fputcsv($salida, [
                proteger_csv($fila["nombre"]),
                proteger_csv($fila["descripcion"]),
                $fila["precio"],
                $fila["stock"],
                proteger_csv($fila["categoria"]),
                proteger_csv($fila["estado"]),
                proteger_csv($fila["editorial"]),
                proteger_csv($fila["imagen"])
            ], ";");
        }
    }

    // Cierra la salida del archivo CSV
    fclose($salida);
    // Termina el script, evitando que se añada cualquier HTML o texto extra depúés del CSV.
    exit;
?>
