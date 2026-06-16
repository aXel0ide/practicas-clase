<?php
    if(file_exists("datos.json")){
        $file = file_get_contents("datos.json");
    }else{
        $file = "";
    }
    
    if(!empty($file)){
        $peliculas = json_decode($file, true);
    }else{
        $peliculas = [
            [
                "titulo" => "Batman",
                "universo" => "DC",
                "anio" => 2002,
                "director" => "Matt Reeves",
                "imagen" => "",
                "formato" => "",
                "sinopsis" => ""
            ],
            [
                "titulo" => "Spider-Man: No Way Home",
                "universo" => "Marvel",
                "anio" => 2021,
                "director" => "Jon Watt",
                "imagen" => "",
                "formato" => "",
                "sinopsis" => ""
            ],
            [
                "titulo" => "Superlópez",
                "universo" => "Español",
                "anio" => 2018,
                "director" => "Javier Ruiz Caldera",
                "imagen" => "",
                "formato" => "",
                "sinopsis" => ""
            ]
        ];
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Películas Basadas en Cómics</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <header>
        <h1>Películas basadas en Cómics</h1>
        <p>Listado dinámico cargado desde un archivo JSON mediante PHP</p>
    </header>
    <main class="contenedor">
        <?php 
            foreach($peliculas as $pelicula){
                echo "
                    <article class='tarjeta'>
                        <img src='" . $pelicula["imagen"] . "' alt='" . $pelicula["titulo"] . "'>
                        <h2>" . $pelicula["titulo"] . "</h2>
                        <p><strong>Universo: </strong>" . $pelicula["universo"] . "</p>
                        <p><strong>Año: </strong>" . $pelicula["anio"] . "</p>
                        <p><strong>Dierctor: </strong>" . $pelicula["director"] . "</p>
                        <p><strong>Formato: </strong>" . $pelicula["formato"] . "</p>
                        <p>" . $pelicula["sinopsis"] . "</p>
                    </article>
                ";
            }
        ?>
    </main>
</body>
</html>