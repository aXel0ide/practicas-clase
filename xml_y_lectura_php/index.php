<?php
    $xml = simplexml_load_file("peliculas.xml");
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
            foreach($xml->pelicula as $pelicula){
                echo "
                    <article class='tarjeta'>
                        <img src='" . $pelicula->imagen . "' alt='" . $pelicula->titulo . "' >
                        <h2>" . $pelicula->titulo . "</h2>
                        <p><strong>Universo: </strong>" . $pelicula->universo . "</p>
                        <p><strong>Año: </strong>" . $pelicula->anio . "</p>
                        <p><strong>Director: </strong>" . $pelicula->director . "</p>
                        <p><strong>Formato: </strong>" . $pelicula->formato . "</p>
                        <p>" . $pelicula->sinopsis . "</p>
                    </article>
                ";
            }
        ?>
    </main>
</body>
</html>
