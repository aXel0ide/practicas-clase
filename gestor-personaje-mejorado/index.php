<?php
    // Iniciamos la sesión para almacenar los personajes
    session_start();

    // Array con personajes iniciales. Es una "base de datos" inicial por si no hay datos en el json
    $personajesIniciales = [
        [
            "nombre" => "Batman",
            "universo" => "DC",
            "tipo" => "Héroe",
            "poder" => "Inteligencia, habilidades de combate, tecnología avanzada",
            "anio" => 1939,
            "imagen" => "./img/batman.jpg",
            "activo" => true
        ],
        [
            "nombre" => "Spider-Man",
            "universo" => "Marvel",
            "tipo" => "Héroe",
            "poder" => "Fuerza, agilidad, habilidades de trepador, sentido arácnido",
            "anio" => 1962,
            "imagen" => "./img/spiderman.jpg",
            "activo" => true
        ],
        [
            "nombre" => "Loki",
            "universo" => "Marvel",
            "tipo" => "Villano",
            "poder" => "Magia, manipulación, astucia",
            "anio" => 1949,
            "imagen" => "./img/loki.jpg",
            "activo" => false
        ],
        [
            "nombre" => "Superlópez",
            "universo" => "Bruguera",
            "tipo" => "Héroe",
            "poder" => "Superfuerza, supervelocidad, vuelo",
            "anio" => 1973,
            "imagen" => "./img/superlopez.jpg",
            "activo" => true
        ],
        [
            "nombre" => "Joker",
            "universo" => "DC",
            "tipo" => "Villano",
            "poder" => "Inteligencia, habilidades de combate, tecnología avanzada",
            "anio" => 1940,
            "imagen" => "./img/joker.jpg",
            "activo" => false
        ],
        [
            "nombre" => "Rhino",
            "universo" => "Marvel",
            "tipo" => "Villano",
            "poder" => "Fuerza, resistencia, armadura de rinoceronte",
            "anio" => 1975,
            "imagen" => "./img/rhino.jpg",
            "activo" => true
        ],
        [
            "nombre" => "Capitán América",
            "universo" => "Marvel",
            "tipo" => "Héroe",
            "poder" => "Fuerza, agilidad, habilidades de combate, escudo indestructible",
            "anio" => 1941,
            "imagen" => "./img/capitanamerica.jpg",
            "activo" => true
        ],
        [
            "nombre" => "Thanos",
            "universo" => "Marvel",
            "tipo" => "Villano",
            "poder" => "Fuerza, resistencia, inteligencia, manipulación de la realidad",
            "anio" => 1973,
            "imagen" => "./img/thanos.jpg",
            "activo" => true
        ],
        [
            "nombre" => "Harley Quinn",
            "universo" => "DC",
            "tipo" => "Villano",
            "poder" => "Habilidades de combate, uso de armas",
            "anio" => 1992,
            "imagen" => "./img/harleyquinn.jpg",
            "activo" => false
        ],
        [
            "nombre" => "Magneto",
            "universo" => "Marvel",
            "tipo" => "Villano",
            "poder" => "Control de metal, magnetismo, control sobre campos electromagnéticos",
            "anio" => 1963,
            "imagen" => "./img/magneto.jpg",
            "activo" => true
        ],
        [
            "nombre" => "Lex Luthor",
            "universo" => "DC",
            "tipo" => "Villano",
            "poder" => "Inteligencia, habilidades de combate, tecnología avanzada",
            "anio" => 1940,
            "imagen" => "./img/lexluthor.jpg",
            "activo" => false
        ],
        [
            "nombre" => "Iron Man",
            "universo" => "Marvel",
            "tipo" => "Héroe",
            "poder" => "Inteligencia, habilidades de combate, tecnología avanzada",
            "anio" => 1963,
            "imagen" => "./img/ironman.jpg",
            "activo" => false
        ]
    ];

    // Guarda la ruita del archivo json donde se almacenan los personajes.
    $ficheroPersonajes = "./personajes.json";

    // Si no hay personajes en la sesión, los cargamos desde el JSON o usamos los iniciales
    if(!isset($_SESSION["personajes"])){
        // Si el JSON existe, lo cargamos y lo guardamos en la sesión
        if(file_exists($ficheroPersonajes)){
            // Leemos el contenido del JSON y lo decodificamos para guardarlo en la sesión
            $contenido = file_get_contents($ficheroPersonajes);
            // Guardamos los personajes del JSON en la sesión como un array
            $_SESSION["personajes"] = json_decode($contenido, true);
        }else{
            // Si no existe el JSON, usamos los personajes iniciales y los guardamos en la sesión
            $_SESSION["personajes"] = $personajesIniciales;
        }
    }

    // Cargamos los personajes desde la sesión para usarlos en la aplicación de forma más códmoda
    $personajes = $_SESSION["personajes"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Personajes Mejorado</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <header>
        <h1>Gestor de Personajes Mejorado</h1>
        <p>Bienvenido al gestor de personajes mejorado</p>
    </header>
    <nav>

    </nav>
    <main>

    </main>
    <footer>
        <p>&copy; 2026 Gestor de Personajes Mejorado. Todos los derechos reservados.</p>
    </footer>
</body>
</html>