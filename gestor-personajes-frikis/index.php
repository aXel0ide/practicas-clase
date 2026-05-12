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
            
            if(empty($nuevoPersonaje["imagen"])){
                $nuevoPersonaje["imagen"] = "./img/default.jpg"; // Imagen por defecto si no se proporciona una
            }

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

        <div class="tarjeta <?php echo $personajeActual["activo"] ? "activo" : "inactivo"; ?>">
            <h2><?php echo $personajeActual["nombre"]; ?></h2>
            <img src="<?php echo $personajeActual["imagen"]; ?>" alt="Imagen de <?php echo $personajeActual["nombre"]; ?>">
            <p><strong>Universo:</strong> <?php echo $personajeActual["universo"]; ?></p>
            <p><strong>Tipo:</strong> <?php echo $personajeActual["tipo"]; ?></p>
            <p><strong>Poderes:</strong> <?php echo $personajeActual["poder"]; ?></p>
            <p><strong>Año de creación:</strong> <?php echo $personajeActual["anio"]; ?></p>
            <p><strong>Activo:</strong> <?php echo $personajeActual["activo"] ? "Sí" : "No"; ?></p>
            <?php 
                if($personajeActual["activo"] == true && $personajeActual["tipo"] == "Héroe"){
                    echo "<p>¡Es un héroe activo!</p>";
                }
            ?>
        </div>

        <div class="busqueda">
            <h2>Búsqueda de Personajes</h2>
            <form action="#resultado_busqueda" method="post">
                <label for="nombre_buscar">Nombre:</label>
                <input type="text" name="nombre_buscar" id="nombre_buscar">
                <button type="submit" name="accion" value="buscar">Buscar</button>
            </form>


            <?php
                if($_SERVER["REQUEST_METHOD"] == "POST" && ($_POST["accion"] ?? "") == "buscar"){
                    $nombreBuscar = $_POST["nombre_buscar"];
                    $encontrado = false;

                    foreach($personajes as $personaje){
                        if(strtolower($personaje["nombre"]) == strtolower($nombreBuscar)){
                            $encontrado = true;

                            echo "<div class='tarjeta' id='resultado_busqueda'>";
                            echo "<h2>" . $personaje["nombre"] . "</h2>";
                            echo "<p><strong>Universo:</strong> " . $personaje["universo"] . "</p>";
                            echo "<p><strong>Tipo:</strong> " . $personaje["tipo"] . "</p>";
                            echo "<p><strong>Poderes:</strong> " . $personaje["poder"] . "</p>";
                            echo "<p><strong>Año de creación:</strong> " . $personaje["anio"] . "</p>";
                            echo "<p><strong>Activo:</strong> " . ($personaje["activo"] ? "Sí" : "No") . "</p>";
                            echo "</div>";
                        }
                    }
                    if(!$encontrado){
                        echo "<p id='resultado_busqueda'>No se encontró ningún personaje con ese nombre.</p>";
                    }
                }
            ?>
        </div>

        <div class="listado">
            <h2>Listado de Personajes</h2>
            <ul>
                <?php 
                    foreach($personajes as $personaje){
                        echo "<li>" . $personaje["nombre"] . " - " . $personaje["universo"] . " - " . $personaje["tipo"] . "</li>";
                    }
                ?>
            </ul>

            <br>

            <h2>Superhéroes</h2>
            <ul>
                <?php 
                    foreach($personajes as $personaje){
                        if($personaje["tipo"] == "Héroe"){
                            echo "<li>" . $personaje["nombre"] . " - " . $personaje["universo"] . "</li>";
                        }
                    }
                ?>
            </ul>

            <br>

            <h2>Villanos</h2>
            <ul>
                <?php 
                    foreach($personajes as $personaje){
                        if($personaje["tipo"] == "Villano"){
                            echo "<li>" . $personaje["nombre"] . " - " . $personaje["universo"] . "</li>";
                        }
                    }
                ?>
            </ul>
        </div>

        <div class="resumen">
            <h2>Resumen</h2>
            <p>Total de personajes: <?php echo count($personajes); ?></p>
            <p>Personajes activos: <?php echo contarActivos($personajes); ?></p>
            <p>Héroes: <?php echo contarPorTipo($personajes, "Héroe"); ?></p>
            <p>Villanos: <?php echo contarPorTipo($personajes, "Villano"); ?></p>
            <p>Primer personaje: <?php echo obtenerPrimerNombre($personajes); ?></p>

            <?php
                $resultadoDC = personajesUniverso($personajes, "DC");
                $resultadoMarvel = personajesUniverso($personajes, "Marvel");
                $resultadoBruguera = personajesUniverso($personajes, "Bruguera");
            ?>

            <p>
                Personajes del universo DC:
                <?php echo $resultadoDC["contador"] . ". Estos son: " . implode(", ", array_column($resultadoDC["personajes"], "nombre"));?>
            </p>

            <p>
                Personajes del universo Marvel:
                <?php echo $resultadoMarvel["contador"] . ". Estos son: " . implode(", ", array_column($resultadoMarvel["personajes"], "nombre")); ?>
            </p>

            <p>
                Personajes del universo Bruguera:
                <?php echo $resultadoBruguera["contador"] . ". Estos son: " . implode(", ", array_column($resultadoBruguera["personajes"], "nombre")); ?>
            </p>
            <p>Personaje más antiguo: <?php echo personajeMasAntiguo($personajes)["nombre"]; ?></p>
        </div>
    </main>
    <footer>
        <p>&copy; 2025 Gestor de Personajes Frikis. Todos los derechos reservados.</p>
    </footer>
</body>
</html>