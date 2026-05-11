<?php

    require_once "funciones.php";

    // Array de personajes de cómics
    $personajes = [
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
        ]
    ];

    $indice = 0; // Índice del personaje actual

    // Si en la URL existe el parámetro "indice", usamos ese valor
    // para saber qué personaje mostrar.
    if(isset($_GET["indice"])){
        $indice = (int) $_GET["indice"];
    }

    // Si el indice es menor que 0, lo corregimos para que no salga del array
    if($indice < 0){
        $indice = 0;
    }

    // Si el indice es mayor que la últmia posición de array, lo ajustamos al último personaje
    if($indice >= count($personajes)){
        $indice = count($personajes) - 1;
    }

    // Guardamos en esta variable el personaje que corresponde al índice elegido
    $personajeActual = $personajes[$indice];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $accion = $_POST["accion"] ?? "";

        if($accion == "modificar"){
            $personajeActual["nombre"] = $_POST["nombre"] ?? $personajeActual["nombre"];
            $personajeActual["universo"] = $_POST["universo"] ?? $personajeActual["universo"];
            $personajeActual["tipo"] = $_POST["tipo"] ?? $personajeActual["tipo"];
            $personajeActual["poder"] = $_POST["poderes"] ?? $personajeActual["poder"];
            $personajeActual["anio"] = $_POST["anio"] ?? $personajeActual["anio"];
            $personajeActual["imagen"] = $_POST["imagen"] ?? $personajeActual["imagen"];
            $personajeActual["activo"] = isset($_POST["activo"]) ? true : false;
            $personajes[$indice] = $personajeActual;
        }

        if($accion == "añadir"){
            $nuevoPersonaje = [
                "nombre" => $_POST["nombre"] ?? "",
                "universo" => $_POST["universo"] ?? "",
                "tipo" => $_POST["tipo"] ?? "",
                "poder" => $_POST["poderes"] ?? "",
                "anio" => $_POST["anio"] ?? 0,
                "imagen" => $_POST["imagen"] ?? "",
                "activo" => isset($_POST["activo"]) ? true : false
            ];
            $personajes[] = $nuevoPersonaje;
            $indice = count($personajes) - 1; // Ajustamos el índice al nuevo personaje
            $personajeActual = $nuevoPersonaje; // Mostramos el nuevo personaje
        }

        if($accion == "borrar"){
            array_splice($personajes, $indice, 1); // Eliminamos el personaje actual
            $indice = 0; // Volvemos al primer personaje
            $personajeActual = $personajes[$indice]; // Mostramos el primer personaje
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Personajes Frikis</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <header>
        <h1>Gestor de Personajes Frikis</h1>
        <p>Bienvenido al gestor de personajes frikis.</p>
    </header>
    <nav class="navegacion">
        <?php funcionNavegacion($personajes, $indice); ?>
    </nav>
    <main>
        <form action="" method="post">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo $personajeActual["nombre"]; ?>">

            <label for="universo">Universo</label>
            <input type="text" name="universo" id="universo" value="<?php echo $personajeActual["universo"]; ?>">

            <label for="tipo">Tipo</label>
            <input type="text" name="tipo" id="tipo" value="<?php echo $personajeActual["tipo"] ?>">

            <label for="poderes">Poderes principales</label>
            <input type="text" name="poderes" id="poderes" value="<?php echo $personajeActual["poder"] ?>">

            <label for="anio">Año de creación</label>
            <input type="number" name="anio" id="anio" value="<?php echo $personajeActual["anio"] ?>">

            <label for="imagen">Imagen</label>
            <input type="text" name="imagen" id="imagen" value="<?php echo $personajeActual["imagen"] ?>">

            <label>
                <input type="checkbox" name="activo" id="activo" <?php echo $personajeActual["activo"] ? "checked" : ""; ?>> Activo
            </label>

            <button type="submit" name="accion" value="modificar">Modificar</button>
            <button type="submit" name="accion" value="añadir">Añadir nuevo</button>
            <button type="submit" name="accion" value="borrar">Borrar actual</button>
        </form>

        <div class="tarjeta">
            <h2><?php echo $personajeActual["nombre"]; ?></h2>
            <p><strong>Universo:</strong> <?php echo $personajeActual["universo"]; ?></p>
            <p><strong>Tipo:</strong> <?php echo $personajeActual["tipo"]; ?></p>
            <p><strong>Poderes:</strong> <?php echo $personajeActual["poder"]; ?></p>
            <p><strong>Año de creación:</strong> <?php echo $personajeActual["anio"]; ?></p>
            <p><strong>Activo:</strong> <?php echo $personajeActual["activo"] ? "Sí" : "No"; ?></p>
        </div>

        <div class="listado">
            <h2>Listado de Personajes</h2>
            <ul>
                <?php 
                    foreach($personajes as $personaje){
                        echo "<li>" . $personaje["nombre"] . " - " . $personaje["universo"] . "- " . $personaje["tipo"] . "</li>";
                    }
                ?>
            </ul>
        </div>
    </main>
    <footer>
        <p>&copy; 2025 Gestor de Personajes Frikis. Todos los derechos reservados.</p>
    </footer>
</body>
</html>