<?php
    // Guarda el nombre del archivo en una variable.
    $archivo = "peliculas.xml";
    // Inicializa $xml como false.
    $xml = false;

    // Comprueba si el archivo existe y si no está vacío.
    if(file_exists($archivo) && filesize($archivo) > 0){
        // Si hay errores leyendo el XML no los muestra.
        libxml_use_internal_errors(true);
        // Intenta cargar el XML, si está bien escrito tendrá el contenido. Si está mal escrito tiene false.
        $xml = simplexml_load_file("peliculas.xml");
        // Limpia los errores internos que haya guardado PHP al intentar leer el XML.
        libxml_clear_errors();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Películas Basadas en Cómics desde XML</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <header>
        <h1>Películas Basadas en Cómics</h1>
        <p>Listado dinámico cargado desde un archivo XML mediante PHP.</p>
    </header>
    <main class="contenedor">
        <?php
            if($xml !== false){
                foreach($xml->pelicula as $pelicula){
                echo "
                    <article class='tarjeta'>
                        <img src='" . $pelicula->imagen . "' alt='" . $pelicula->titulo . "' >
                        <h2>" . $pelicula->titulo . "</h2>
                        <p><strong>Protagonista: </strong>" . $pelicula->protagonista. "</p>
                        <p><strong>Universo: </strong>" . $pelicula->universo . "</p>
                        <p><strong>Año: </strong>" . $pelicula->anio . "</p>
                        <p><strong>Director: </strong>" . $pelicula->director . "</p>
                        <p><strong>Formato: </strong>" . $pelicula->formato . "</p>
                        <p><strong>Duración: </strong>" . $pelicula->duracion . " minutos.</p>
                        <p>" . $pelicula->sinopsis . "</p>
                    </article>
                ";
                }
            }else{
                echo "<h2>El archivo peliculas.xml está vacío.</h2>";
            }
        ?>
    </main>
</body>
</html>
