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
            "sinopsis" => "Nueva visión oscura del personaje con tono detectivesco.",
            "duracion" => 190
        ],
        [
            "titulo" => "Spider-Man: No Way Home",
            "universo" => "Marvel",
            "anio" => 2021,
            "director" => "Jon Watts",
            "formato" => "Superhéroes",
            "imagen" => "https://upload.wikimedia.org/wikipedia/en/0/00/Spider-Man_No_Way_Home_poster.jpg",
            "sinopsis" => "Peter Parker afronta las consecuencias de que se conozca su identidad.",
            "duracion" => 90
        ],
        [
            "titulo" => "Superlópez",
            "universo" => "Español",
            "anio" => 2018,
            "director" => "Javier Ruiz Caldera",
            "formato" => "Comedia",
            "imagen" => "https://static.wikia.nocookie.net/ficcion-sin-limites/images/8/84/Poster-superlopez.jpg/revision/latest?cb=20260524232251&path-prefix=es",
            "sinopsis" => "Adaptación cinematográfica del famoso personaje español.",
            "duracion" => 120
        ],
        [
            "titulo" => "Mortadelo y Filemón contra Jimmy el Cachondo",
            "universo" => "Español",
            "anio" => 2014,
            "director" => "Javier Fesser",
            "formato" => "Animación",
            "imagen" => "https://static.wikia.nocookie.net/mortadelo/images/2/25/Mortadelo_y_Filem%C3%B3n_contra_Jimmy_el_cachondo.jpg/revision/latest?cb=20150824135309&path-prefix=es",
            "sinopsis" => "Aventura disparatada basada en los personajes clásicos de Ibáñez.",
            "duracion" => 80
        ],
        [
            "titulo" => "Ocho apellidos vascos",
            "universo" => "Español",
            "anio" => 2014,
            "director" => "Emilio Martínez-Lázaro",
            "formato" => "Comedia/Romance",
            "imagen" => "https://static.wikia.nocookie.net/entrenoticias/images/f/fa/Cartel_8_apellidos_vascos.jpg/revision/latest?cb=20151211092612&path-prefix=es",
            "sinopsis" => "Rafael, un sevillano que nunca ha dejado Andalucía, decide salir de su tierra natal para seguir a Amaia, una chica vasca que no se parece a ninguna otra mujer que haya conocido.",
            "duracion" => 50
        ],
        [
            "titulo" => "Las Aventuras de Tadeo Jones",
            "universo" => "Español",
            "anio" => 2012,
            "director" => "Enrique Gato",
            "formato" => "Infantil/Aventura",
            "imagen" => "https://static.wikia.nocookie.net/wiki-doblaje-espana/images/8/80/Las_aventuras_de_Tadeo_Jones.png/revision/latest?cb=20220416145654&path-prefix=es",
            "sinopsis" => "Tadeo, un albañil soñador que trabaja en Madrid, es confundido por accidente con un eminente arqueólogo. Gracias a esto, es enviado a una expedición a Perú. Junto a una intrépida arqueóloga, su perro Jeff, un loro mudo y un peculiar guía, intentará salvar la mítica ciudad de Paititi de unos malvados cazatesoros.",
            "duracion" => 220
        ]
    ];

    echo json_encode($peliculas, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
?>