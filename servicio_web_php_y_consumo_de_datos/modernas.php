<?php
    $url = "http://localhost/practicas-clase/servicio_web_php_y_consumo_de_datos/servicio_peliculas.php";

    $respuesta = file_get_contents($url);

    $peliculas = json_decode($respuesta, true);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Películas Españolas</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <header>
        <h1>Películas Modernas</h1>
        <p>Datos obtenidos desde un servicio PHP en formato JSON.</p>
    </header>
    <main class="contenedor">
        <?php 
            foreach($peliculas as $pelicula){
                if($pelicula["anio"] > 2020){
                    echo "
                        <article class='tarjeta'>
                            <img src='" . $pelicula["imagen"] . "' alt='" . $pelicula["titulo"] . "'>
                            <h2>" . $pelicula["titulo"] . "</h2>
                            <p><strong>Universo: </strong>" . $pelicula["universo"] . "</p>
                            <p><strong>Año: </strong>" . $pelicula["anio"] . "</p>
                            <p><strong>Director: </strong>" .$pelicula["director"] . "</p>
                            <p><strong>Formato: </strong>" . $pelicula["formato"] . "</p>
                            <p>" . $pelicula["sinopsis"] . "</p>
                        </article>
                    ";
                }
            }
        ?>
    </main>
</body>
</html>