<?php
    /* ESTE ARCHIVO FUNCIONA COMO UNA API: RECIBE FILTROS POR LA URL Y DEVUELVE DATOS EN FORMATO JSON. */

    // Dice al navegador que la respuesta será JSON.
    header("Content-Type: application/json; charset=UTF-8");

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

    // Lee los parámetros de la URL.

    // Si en la URL viene ?univeros=Marvel, guarda Marvel, si no, guarda "".
    $universo = $_GET["universo"] ?? "";
    // Si en la URL viene ?min_anio=2018, guarda 2018, si no, guarda "".
    $min_anio = $_GET["min_anio"] ?? "";

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

        // Si la pelicula coincide la guarda en $resultado.
        if($coincide){
            $resultado[] = $pelicula;
        }
    }

    // Crea la respuesta final.
    /* MONTA UN ARRAY CON:
        - ESTADO: INDICA QUE LA API RESPONDIÓ BIEN.
        - TOTAL: CUANTOS RESULTADOS HAY.
        - FILTROS: QUE FILTROS SE USARON.
        - DATOS: PELICULAS ENCONTRADAS.
    */
    $respuesta = [
        "estado" => "ok",
        "total" => count($resultado),
        "filtros" => [
            "universo" => $universo,
            "min_anio" => $min_anio
        ],
        "datos" => $resultado
    ];

    // Finalmente convierte el array PHP a JSON y lo muestra bonito.
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>