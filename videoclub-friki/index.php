<?php
    include_once "funciones.php";

    $videoclub = [
        [
            "titulo" => "Batman",
            "anio" => 1989,
            "genero" => "Acción",
            "puntuacion" => 8.5,
            "disponible" => true,
            "precio" => 3.50,
            "formato" => "DVD"
        ],
        [
            "titulo" => "Superman",
            "anio" => 1978,
            "genero" => "Aventura",
            "puntuacion" => 8.0,
            "disponible" => false,
            "precio" => 3.00,
            "formato" => "DVD"
        ],
        [
            "titulo" => "Spider-Man",
            "anio" => 2004,
            "genero" => "Acción",
            "puntuacion" => 7.8,
            "disponible" => false,
            "precio" => 3.75,
            "formato" => "Blu-ray"
        ],
        [
            "titulo" => "Superlópez",
            "anio" => 2018,
            "genero" => "Comedia",
            "puntuacion" => 6.9,
            "disponible" => true,
            "precio" => 2.80,
            "formato" => "Digital"
        ],
        [
            "titulo" => "Mortadelo y Filemón",
            "anio" => 2003,
            "genero" => "Comedia",
            "puntuacion" => 6.5,
            "disponible" => false,
            "precio" => 2.50,
            "formato" => "Digital"
        ],
        [
            "titulo" => "Shin-chan: Los adultos contraatacan",
            "anio" => 2001,
            "genero" => "Comedia",
            "puntuacion" => 10,
            "disponible" => true,
            "precio" => 4.50,
            "formato" => "Blu-ray"
        ],
        [
            "titulo" => "Avengers: Infinity War",
            "anio" => 2018,
            "genero" => "Acción",
            "puntuacion" => 8.0,
            "disponible" => false,
            "precio" => 3.50,
            "formato" => "Digital"
        ]
    ];

    $mejorPelicula = obtenerMejorPuntuada($videoclub);
    $peliculaBarata = obtenerMasBarata($videoclub);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videoclub</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <header>
        <h1>Videoclub Friki</h1>
    </header>
    <main>
        <div>
            <table>
                <caption>Pelícuas del Videoclub</caption>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Año</th>
                        <th>Género</th>
                        <th>Puntuación</th>
                        <th>Disponible</th>
                        <th>Formato</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                        <?php 
                            foreach($videoclub as $pelicula){
                                echo "<tr>";
                                    echo "<td>" . $pelicula["titulo"] . "</td>";
                                    echo "<td>" . $pelicula["anio"] . "</td>";
                                    echo "<td>" . $pelicula["genero"] . "</td>";
                                    echo "<td>" . $pelicula["puntuacion"] . "</td>";
                                    echo "<td>" . ($pelicula["disponible"] ? "Sí" : "No") . "</td>";
                                    echo "<td>" . $pelicula["formato"] . "</td>";
                                    echo "<td>" . number_format($pelicula["precio"], 2, ",", ".") . "€</td>";
                                echo "</tr>";
                            }
                        ?>
                </tbody>
            </table>
            <br>
            <table>
                <caption>Películas disponibles</caption>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Año</th>
                        <th>Género</th>
                        <th>Puntuación</th>
                        <th>Formato</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($videoclub as $pelicula){
                            if($pelicula["disponible"]){
                                echo "<tr>";
                                    echo "<td>" . $pelicula["titulo"] . "</td>";
                                    echo "<td>" . $pelicula["anio"] . "</td>";
                                    echo "<td>" . $pelicula["genero"] . "</td>";
                                    echo "<td>" . $pelicula["puntuacion"] . "</td>";
                                    echo "<td>" . $pelicula["formato"] . "</td>";
                                    echo "<td>" . number_format($pelicula["precio"], 2, ",", ".") . "€</td>";
                                echo "</tr>";   
                            }
                        }
                    ?>
                </tbody>
            </table>

            <table>
                <caption>Películas posteriores al año 2000</caption>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Año</th>
                        <th>Género</th>
                        <th>Puntuación</th>
                        <th>Disponible</th>
                        <th>Formato</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($videoclub as $pelicula){
                            if($pelicula["anio"] >= 2000){
                                echo "<tr>";
                                    echo "<td>" . $pelicula["titulo"] . "</td>";
                                    echo "<td>" . $pelicula["anio"] . "</td>";
                                    echo "<td>" . $pelicula["genero"] . "</td>";
                                    echo "<td>" . $pelicula["puntuacion"] . "</td>";
                                    echo "<td>" . ($pelicula["disponible"] ? "Sí" : "No") . "</td>";
                                    echo "<td>" . $pelicula["formato"] . "</td>";
                                    echo "<td>" . number_format($pelicula["precio"], 2, ",", ".") . "€</td>";
                                echo "</tr>";   
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
        
        <div>
            <h2>Resumen del videoclub</h2>
            <p><strong>Total de películas: </strong> <?php echo count($videoclub); ?></p>
            <p><strong>Películas disponibles: </strong><?php echo contarDisponible($videoclub) ?></p>
            <p><strong>Precio medio: </strong><?php echo number_format(calcularPrecioMedio($videoclub), 2, ",", ".") ?>€</p>
            <p><strong>Precio total de todas las películas juntas: </strong><?php echo number_format(precioGeneral($videoclub), 2, ",", "."); ?>€</p>
            <p><strong>Mejor valorada: </strong><?php echo $mejorPelicula["titulo"] . ". Con una puntuación de " . $mejorPelicula["puntuacion"] ?></p>
            <p><strong>Películas con una puntuación igual o superior a 8: </strong><?php echo mejorValoradas($videoclub); ?></p>
            <p><strong>Película más barata: </strong><?php echo $peliculaBarata["titulo"] . ". Precio: " . number_format($peliculaBarata["precio"], 2, ",", "."); ?>€</p>

            <div>
                <h2>Recomendaciones</h2>
                    <div>
                        <h3>Películas que recomendamos</h3>
                        <ol>
                            <?php
                                foreach($videoclub as $pelicula){
                                    if($pelicula["puntuacion"] < 7 || $pelicula["titulo"] == "Shin-chan: Los adultos contraatacan"){
                                        echo "<li>" . $pelicula["titulo"] ."</li>";
                                    }
                                }
                            ?>
                        </ol>
                    </div>

                    <div>
                        <h3>Películas que NO recomendamos</h3>
                        <ol>
                            <?php 
                                foreach($videoclub as $pelicula){
                                    if($pelicula["puntuacion"] >= 7 && $pelicula["titulo"] != "Shin-chan: Los adultos contraatacan"){
                                        echo "<li>" . $pelicula["titulo"] . "</li>";
                                    }
                                }
                            ?>
                        </ol>
                    </div>
            </div>

            <div>
                <h2>Películas de Comedia</h2>
                <h3>Títulos</h3>
                <ol>
                    <?php 
                        $contador = 0;
                        foreach($videoclub as $pelicula){
                            if($pelicula["genero"] == "Comedia"){
                                echo "<li>" . $pelicula["titulo"] .  "</li>";
                                $contador++;
                            }
                        }
                    ?>
                </ol>
                <h3>Número de películas</h3>
                <p><?php echo $contador; ?></p>
            </div>

            <h2>Títulos de las películas</h2>
            <ul>
                <?php crearLista($videoclub); ?>
            </ul>
        </div>
    </main>
</body>
</html>