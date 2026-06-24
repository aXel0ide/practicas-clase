<?php
    /* CATALOGO.PHP ES LA PÁGINA QUE MUESTRA UN CATÁLOGO EN HTML, PERO LOS DATOS NO LOS TIENE, LOS PIDE A LA API */

    function limpiar(string $texto){
        return htmlspecialchars($texto, ENT_QUOTES, "UTF-8");
    }

    // Recoge filtros de la URL por si existiesen datos en ella, si no, se guardan como cadena vacía.
    $universo = $_GET["universo"] ?? "";
    $min_anio = $_GET["min_anio"] ?? "";
    $formato = $_GET["formato"] ?? "";
    $orden = $_GET["orden"] ?? "";
    $valoracion_min = $_GET["valoracion_min"] ?? "";

    // Define la URL.
    $url = "http://localhost/practicas-clase/api_rest_basica_php/api_peliculas_segura.php";

    // Array de parámetros.
    $parametros = [
        "clave" => "curso2026"
    ];

    // Si hay filtro de universo se añade.
    if($universo != ""){
        // urlencode() convierte un texto normal en un texto seguro para meterlo en una URL
        // Es necesario si en la URL hay caracteres que pueden dar problemas, tildes, ñ, :, etc.
        $parametros["universo"] = $universo;
    }

    // Si hay filtro de año mínimo se añade.
    if($min_anio != ""){
        $parametros["min_anio"] = $min_anio;
    }

    // Si hay filtro de formato se añade.
    if($formato != ""){
        $parametros["formato"] = $formato;
    }

    // Si hay filtro de valoracion minima se añade.
    if($valoracion_min != ""){
        $parametros["valoracion_min"] = $valoracion_min;
    }

    // Si hay filtro de orden se añade.
    if($orden != ""){
        $parametros["orden"] = $orden;
    }

    // Construyr la parte final de una URL con los parámetros.
    $url .= "?" . http_build_query($parametros);

    // Crea una configuración especial para cuando se haga una petición a la API.
    // Crea un "contexto" (conjunto de opciones que PHP usará luego al hacer una petición) de conexión.
    $contexto = stream_context_create([
        // Indica que las opciones que vienen dentro son para peticiones HTTP.
        "http" => [
            /* Por defecto, si file_get_contents() llama a una URL y esa URL responde con error HTTP, por ejemplo
            401, 404 o 500, puede no devolverte bien el cuerpo de la respuesta.
            Con esto le dices a PHP que aunque la API responda con error HTTP, lee igualmente el contendido de 
            la respuesta. */
            "ignore_errors" => true
        ]
    ]);

    // Llama a la API, lee el contendido y leerá la respuesta del JSON aunque sea un error 400.
    $respuesta_json = file_get_contents($url, false, $contexto);
    // Convierte el JSON a un array de PHP, true hace que se convierta en array asociativo.
    $respuesta = json_decode($respuesta_json, true);

    // Comrpueba si la respuesta vale null. Esto puede pasar si el json_decode() no ha podido interpretar el JSON.
    if($respuesta === null){
        // Si es null, crea una respuesta manual de error para que el resto del código no falle.
        $respuesta = [
            "estado" => "error",
            "mensaje" => "No se ha podido interpretar la respuesta de la API.",
            "total" => 0,
            "datos" => []
        ];
    }

    // Saca las películas de la respuesta y las guarda.
    $peliculas = $respuesta["datos"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo desde API segura</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <header>
        <h1>Catálogo desde API segura</h1>
        <p>Consumo de una API con validación, errores controlados y respuesta JSON uniforme.</p>
        <nav>
            <a href="./index.php">Inicio</a>
            <a href="./catalogo_seguro.php">Catálogo Completo</a>
            <a href="./api_documentacion.php">Documentación</a>
        </nav>
    </header>
    <main class="contenedor">
        <section class="panel">
            <h2>Filtrar catálogo</h2>
            
            <form action="./catalogo_seguro.php" method="get">
                <label for="universo">Universo</label>

                <select name="universo" id="universo">
                    <option value="">Todos</option>
                    <option value="Marvel">Marvel</option>
                    <option value="DC">DC</option>
                    <option value="Español">Español</option>
                </select>

                <label for="min_anio">Año mínimo</label>
                <input type="number" name="min_anio" id="min_anio" placeholder="Ejemplo: 2020">

                <label for="formato">Formato</label>
                
                <select name="formato" id="formato">
                    <option value=""> -- Cualquier formato -- </option>
                    <option value="Acción">Acción</option>
                    <option value="Comedia">Comedia</option>
                    <option value="Superhéroes">Superhéroes</option>
                </select>

                <label for="ordenar">Ordenar por</label>
                <select name="orden" id="orden">
                    <option value="">Sin ordenar</option>
                    <option value="anio_desc">Año: mayor a menor</option>
                    <option value="valoracion_desc">Valoración: mayor a menor</option>
                </select>

                <label for="valoracion_min">Valoración mínima</label>
                <input type="number" step="0.1" name="valoracion_min" id="valoracion_min" placeholder="Ejemplo: 7">

                <button type="submit">Aplicar Filtros</button>
            </form>

            <p><strong>Mensaje de la API: </strong> <?php echo limpiar($respuesta["mensaje"]) ?></p>
            <p><strong>Total: </strong> <?php echo  limpiar($respuesta["total"]) ?></p>
        </section>
        <section class="rejilla">
            <?php 
                if($respuesta["estado"] !== "ok"){
                    echo "<p>No se pueden mostrar resultados porque la API ha devuelto un error.</p>";
                }elseif(count($peliculas) == 0){
                    echo "<p>No hay películas que coincidan con esos fitros.</p>";
                }else{
                    // Recorre las películas. Por cada una genera una tarjeta.
                    foreach($peliculas as $pelicula){
                        echo "
                        <article class='tarjeta'>
                            <h2>" . $pelicula["titulo"] . "</h2>
                            <p><strong>Universo: </strong>" . limpiar($pelicula["universo"]) . "</p>
                            <p><strong>Año: </strong>" . limpiar($pelicula["anio"]) . "</p>
                            <p><strong>Director: </strong>" . limpiar($pelicula["director"]) . "</p>
                            <p><strong>Formato: </strong>" . limpiar($pelicula["formato"]) . "</p>
                            <p><strong>Valoracion: </strong>" . limpiar($pelicula["valoracion"]) . "</p>
                        </article>
                    ";
                    }
                }
            ?>
        </section>
    </main>
</body>
</html>
