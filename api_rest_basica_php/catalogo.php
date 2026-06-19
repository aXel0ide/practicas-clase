<?php
    /* CATALOGO.PHP ES LA PÁGINA QUE MUESTRA UN CATÁLOGO EN HTML, PERO LOS DATOS NO LOS TIENE, LOS PIDE A LA API */

    // Recoge filtros de la URL por si existiesen datos en ella, si no, se guardan como cadena vacía.
    $universo = $_GET["universo"] ?? "";
    $min_anio = $_GET["min_anio"] ?? "";
    $formato = $_GET["formato"] ?? "";
    $valoracion_min = $_GET["valoracion_min"] ?? "";

    // Define la URL.
    $url = "http://localhost/practicas-clase/api_rest_basica_php/api_peliculas.php";

    // Array de parámetros.
    $parametros = [];

    // Si hay filtro de universo se añade.
    if($universo != ""){
        // urlencode() convierte un texto normal en un texto seguro para meterlo en una URL
        // Es necesario si en la URL hay caracteres que pueden dar problemas, tildes, ñ, :, etc.
        $parametros[] = "universo=" . urlencode($universo);
    }

    // Si hay filtro de año mínimo se añade.
    if($min_anio != ""){
        $parametros[] = "min_anio=" . urlencode($min_anio);
    }

    // Si hay filtro de formato se añade.
    if($formato != ""){
        $parametros[] = "formato=" . urlencode($formato);
    }

    // Si hay filtro de valoracion minima se añade.
    if($valoracion_min != ""){
        $parametros[] = "valoracion_min=" . urldecode($valoracion_min);
    }

    // Si hay parámetros(filtros), los une a la URL
    if(count($parametros) > 0){
        // implode() une los elementos de un array en un solo texto, usando un separador.
        $url .= "?" . implode("&", $parametros);
    }

    // Llama a la API, esto obtiene el JSON que devuelve api_peliculas.php.
    $respuesta_json = file_get_contents($url);
    // Convierte el JSON a un array de PHP, true hace que se convierta en array asociativo.
    $respuesta = json_decode($respuesta_json, true);
    // Saca las películas.
    $peliculas = $respuesta["datos"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo desde API REST básica</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <header>
        <h1>Catálogo de películas desde una API REST básica</h1>
        <p>Los datps se solicitan a una API PHP usando parámetros GET.</p>
        <nav>
            <a href="./index.php">Inicio</a>
            <a href="./catalogo.php">Catálogo Completo</a>
        </nav>
    </header>
    <main class="contenedor">
        <section class="panel">
            <h2>Filtrar catálogo</h2>
            
            <form action="./catalogo.php" method="get">
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

                <label for="valoracion_min">Valoración mínima</label>
                <input type="number" name="valoracion_min" id="valoracion_min" placeholder="Ejemplo: 7">

                <button type="submit">Aplicar Filtros</button>
            </form>

            <p>Total de resultados: <?php echo $respuesta["total"] ?>.</p>
        </section>
        <section class="rejilla">
            <?php 
                // Primero comprueba si no hay resultados.
                if(count($peliculas) == 0){
                    echo "<p>No se han encontrado películas con esos filtros.</p>";
                }else{
                    // Recorre las películas. Por cada una genera una tarjeta.
                    foreach($peliculas as $pelicula){
                        echo "
                        <article class='tarjeta'>
                            <h2>" . $pelicula["titulo"] . "</h2>
                            <p><strong>Universo: </strong>" . $pelicula["universo"] . "</p>
                            <p><strong>Año: </strong>" . $pelicula["anio"] . "</p>
                            <p><strong>Director: </strong>" . $pelicula["director"] . "</p>
                            <p><strong>Formato: </strong>" . $pelicula["formato"] . "</p>
                            <p><strong>Valoracion: </strong>" . $pelicula["valoracion"] . "</p>
                        </article>
                    ";
                }
                }
            ?>
        </section>
    </main>
</body>
</html>