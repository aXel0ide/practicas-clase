<?php
    header("Content-Type: application/json; charset=UTF-8");

    $peliculas = [
        [
            "titulo" => "Batman",
            "universo" => "DC",
            "anio" => 2022,
            "director" => "Matt Reeves",
            "formato" => "Acción",
            "imagen" => "https://static.wikia.nocookie.net/marvel_dc/images/4/48/The_Batman_Movie_001.jpg/revision/latest?cb=20211228154331",
            "sinopsis" => "Nueva visión oscura del personaje con tono detectivesco."
        ],
        [
            "titulo" => "Spider-Man: No Way Home",
            "universo" => "Marvel",
            "anio" => 2021,
            "director" => "Jon Watts",
            "formato" => "Superhéroes",
            "imagen" => "https://upload.wikimedia.org/wikipedia/en/0/00/Spider-Man_No_Way_Home_poster.jpg",
            "sinopsis" => "Peter Parker afronta las consecuencias de que se conozca su identidad."
        ],
        [
            "titulo" => "Superlópez",
            "universo" => "Español",
            "anio" => 2018,
            "director" => "Javier Ruiz Caldera",
            "formato" => "Comedia",
            "imagen" => "https://static.wikia.nocookie.net/ficcion-sin-limites/images/8/84/Poster-superlopez.jpg/revision/latest?cb=20260524232251&path-prefix=es",
            "sinopsis" => "Adaptación cinematográfica del famoso personaje español."
        ],
        [
            "titulo" => "Mortadelo y Filemón contra Jimmy el Cachondo",
            "universo" => "Español",
            "anio" => 2014,
            "director" => "Animación",
            "formato" => "Animación",
            "imagen" => "https://static.wikia.nocookie.net/mortadelo/images/2/25/Mortadelo_y_Filem%C3%B3n_contra_Jimmy_el_cachondo.jpg/revision/latest?cb=20150824135309&path-prefix=es",
            "sinopsis" => "Aventura disparatada basada en los personajes clásicos de Ibáñez."
        ]
    ];

    echo json_encode($peliculas, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
?>