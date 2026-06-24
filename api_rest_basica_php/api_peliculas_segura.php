<?php
    /* ESTE ARCHIVO FUNCIONA COMO UNA API: RECIBE FILTROS POR LA URL Y DEVUELVE DATOS EN FORMATO JSON. */

    // Dice al navegador que la respuesta será JSON.
    header("Content-Type: application/json; charset=UTF-8");

    // Define una función para construir y enviar una respuesta JSON desde la API
    function responder_json(int $codigo, string $estado, string $mensaje, $datos = [], $filtros = []){
        // Establece el código HTTP real de la respuesta.
        /* POR EJEMPLO. $CODIGO = 404, EL NAVEGADOR O CLIENTE RECIBIRÁ UNA RESPUESTA HTTP 404 */
        http_response_code($codigo);

        // Array asociativo que será la estructura final que luego se convertirá a JSON.
        $respuesta = [
            "estado" => $estado,
            "codigo" => $codigo,
            "mensaje" => $mensaje,
            "total" => count($datos),
            "filtros" => $filtros,
            "datos" => $datos
        ];

        // Convierte el array a respuesta JSON.
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    // Guarda una clave válida.
    const CLAVE_CORRECTA = "curso2026";
    // Clave de lectura
    const CLAVE_LECTURA = "clave_lectura2026";
    // Lee de la URL un parámetro llamado URL y si no hay clave guarda "".
    $clave_recibida = $_GET["clave"] ?? "";

    // Compara la clave recibida con la clave correcta, si no es igual la API responde con un JSON usando la función.
    if($clave_recibida !== CLAVE_CORRECTA && $clave_recibida !== CLAVE_LECTURA){
        responder_json(401, "error", "No autorizado. Falta una clave válida.");
    }

    // Array bidimensional numérico de películas. Cada película es un array asociativo.
    $peliculas = [
        [
            "titulo" => "Batman",
            "universo" => "DC",
            "anio" => 2002,
            "director" => "Matt Reeves",
            "formato" => "Acción",
            "valoracion" => 8.2
        ],
        [
            "titulo" => "Spider-Man: No Way Home",
            "universo" => "Marvel",
            "anio" => 2021,
            "director" => "Jon Watt",
            "formato" => "Superhéroes",
            "valoracion" => 8.0
        ],
        [
            "titulo" => "Superlópez",
            "universo" => "Español",
            "anio" => 2018,
            "director" => "Javier Ruiz Caldera",
            "formato" => "Comedia",
            "valoracion" => 6.1
        ],
        [
            "titulo" => "Mortadelo y Filemón contra Jimmy el Cachondo",
            "universo" => "Español",
            "anio" => 2014,
            "director" => "Javier Ruiz Caldera",
            "formato" => "Comedia",
            "valoracion" => 6.1
        ],
        [
            "titulo" => "Black Panter",
            "universo" => "Marvel",
            "anio" => 2018,
            "director" => "Ryan Coogler",
            "formato" => "Superhéroes",
            "valoracion" => 7.3
        ]
    ];

    // Crea 2 arrays donde almacena los universos y formatos permitidos.
    $universos_permitidos = ["", "Marvel", "DC", "Español"];
    $formatos_permitidos = ["", "Acción", "Superhéroes", "Comedia", "Animación"];

    // Lee los parámetros de la URL.

    // Si en la URL viene ?univeros=Marvel, guarda Marvel, si no, guarda "".
    $universo = $_GET["universo"] ?? "";
    // Si en la URL viene ?min_anio=2018, guarda 2018, si no, guarda "".
    $min_anio = $_GET["min_anio"] ?? "";
    // Si la url viene con ?formato=Comedia, guarda Comedia, si no, guarda "".
    $formato = $_GET["formato"] ?? "";
    // Si la url viene con ?valoracion_min=5, guarda 5, si no, guarda "".
    $valoracion_min = $_GET["valoracion_min"] ?? "";
    // Si la url viene con ?orden=anio_desc, guarda anio_desc, si no, guarda "".
    $orden = $_GET["orden"] ?? "";

    // Valores permitidos para el orden.
    $ordenes_permitidas = ["", "anio_desc", "valoracion_desc"];

    // Comprueba que el universo que se le ha pasado está dentro de los universos permitidos.
    if(!in_array($universo, $universos_permitidos)){
        responder_json(400, "error", "El universo indicado no es válido.");
    }

    // Commprueba que el formato que se le ha pasado está dentro de los formatos permitidos.
    if(!in_array($formato, $formatos_permitidos)){
        responder_json(400, "error", "El formato indicado no es válido.");
    }

    // Comprueba que, si se le ha pasado un año, este sea numérico, mayor a 1900 o no superior al año actual.
    if($min_anio !== "" && (!is_numeric($min_anio) || $min_anio < 1900 || $min_anio > date("Y"))){
        responder_json(400, "error", "El año debe ser numérico y razonable.");
    }

    // Compruega que, si se le ha pasado una valoración, esta sea numérica, mayor a 0 y menor a 10.
    if($valoracion_min !== "" && (!is_numeric($valoracion_min) || $valoracion_min < 0 || $valoracion_min > 10)){
        responder_json(400, "error", "La valoración mínima debe estar entre 0 y 10.");
    }

    // Comprueba que el valor que se le ha asignado a $orden es válido.
    if(!in_array($orden, $ordenes_permitidas)){
        responder_json(400, "error", "El orden indicado no es válido.");
    }

    // Array donde se guardan los resultados.
    $resultado = [];

    // Recorre todas las películas.
    foreach($peliculas as $pelicula){
        // Valor true porque cada película debería empezar coicidiendo.
        $coincide = true;

        // Comprueba si cada película coincide con los filtros.
        // Si el usuario ha pedido un universo concreto y la película no pertenece al universo entonces no coincide.
        if($universo != "" && $pelicula["universo"] != $universo){
            $coincide = false;
        }
        // Si el usuario ha puesto un año mínimo y la película es anterior a ese año, entonces no coincide.
        if($min_anio != "" && $pelicula["anio"] < $min_anio){
            $coincide = false;
        }
        // Si el usuario ha puesto un formato concreto y la pelicula no tiene ese formato entonces no coincide.
        if($formato != "" && $pelicula["formato"] != $formato){
            $coincide = false;
        }

        if($valoracion_min != "" && $pelicula["valoracion"] < $valoracion_min){
            $coincide = false;
        }

        // Si la pelicula coincide la guarda en $resultado.
        if($coincide){
            $resultado[] = $pelicula;
        }
    }

    // En este punto $resultado contiene las películas que han pasado los filtros.

    // Si el usuario ha pedido ordenar por año de mayor a menor.
    if($orden == "anio_desc"){
        /*
            usort() ordena el array $resultado.
            Para hacerlo, PHP compara las películas de dos en dos.
            En cada comparación, $a representa una película y $b representa otra.
            Nosotros solo indicamos la regla de ordenación.
        */
        usort($resultado, function ($a, $b) {
        /*
            El operador <=> compara dos valores:
            - devuelve -1 si el valor de la izquierda es menor
            - devuelve 0 si son iguales
            - devuelve 1 si el valor de la izquierda es mayor

            Al escribir $b["anio"] <=> $a["anio"],
            invertimos la comparación normal y conseguimos ordenar
            los años de mayor a menor.

            CHULETA
            $a["anio"] <=> $b["anio"]; // menor a mayor
            $b["anio"] <=> $a["anio"]; // mayor a menor
        */
            return $b["anio"] <=> $a["anio"];
        });
    }

    // Si el usuario ha pedido ordenar por valoración de mayor a menor.
    if($orden == "valoracion_desc"){
        usort($resultado, function ($a, $b) {
            return $b["valoracion"] <=> $a["valoracion"];
        });
    }

    $filtros = [
        "universo" => $universo,
        "formato" => $formato,
        "min_anio" => $min_anio,
        "valoracion_min" => $valoracion_min
    ];
    
    responder_json(200, "ok", "Consulta realizada correctamente.", $resultado, $filtros);
?>