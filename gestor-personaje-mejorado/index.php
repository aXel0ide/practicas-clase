<?php
    // Iniciamos la sesión para almacenar los personajes
    session_start();
    include_once("./funciones.php");

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

    date_default_timezone_set("Europe/Madrid");

    if(file_exists($ficheroPersonajes)){
        $fechaActualizacion = date("d/m/Y H:i:s", filemtime($ficheroPersonajes));
    }else{
        $fechaActualizacion = "No se han guardado cambios aún";
    }

    // Si no hay personajes en la sesión, los cargamos desde el JSON o usamos los iniciales
    if(!isset($_SESSION["personajes"])){
        // Si el JSON existe, lo cargamos y lo guardamos en la sesión
        if(file_exists($ficheroPersonajes)){
            // Leemos el contenido del JSON y lo decodificamos para guardarlo en la sesión
            $contenido = file_get_contents($ficheroPersonajes);
            // Guardamos los personajes del JSON en la sesión como un array
            $personajesJson = json_decode($contenido, true);

            if(is_array($personajesJson)){
                // Si el JSON es un array válido, lo guardamos en la sesión
                $_SESSION["personajes"] = $personajesJson;
            }else{
                // Si el JSON no es un array válido, usamos los personajes iniciales
                $_SESSION["personajes"] = $personajesIniciales;
            }
        }else{
            // Si no existe el JSON o está vacío, usamos los personajes iniciales y los guardamos en la sesión
            $_SESSION["personajes"] = $personajesIniciales;
        }
    }

    // Cargamos los personajes desde la sesión para usarlos en la aplicación de forma más códmoda
    $personajes = $_SESSION["personajes"];

    // Control de errores. Evitamos que el indice sea negativo o mayor que el número de personajes disponibles
    // Inicializamos el índice a 0 por defecto
    $indice = 0;
    
    if(isset($_GET["indice"])){
        $indice = $_GET["indice"];
    }

    if($indice < 0){
        $indice = 0;
    }

    if(count($personajes) > 0 && $indice >= count($personajes)){
        $indice = count($personajes) - 1;
    }

    $personajeActual = $personajes[$indice];

    // Llamamos a la función de errores para validar los datos del formulario y guardamos los errores en una variable
    $errores = errores();

    if($_SERVER["REQUEST_METHOD"] == "POST" && empty($errores)){
        [$personajes, $indice, $personajeActual] = accionFormulario($personajes, $indice, $personajeActual, $personajesIniciales, $ficheroPersonajes);

        // Actualizamos la sesión con los personajes modificados o añadidos
        $_SESSION["personajes"] = $personajes;

        // Se guarda el array de personajes en el archivo JSON
        // Convierte el array de PHP a texto JSON
        $textoJson = json_encode($personajes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        // Guarda el texto JSON en el archivo, sobrescribiendo su contenido
        file_put_contents($ficheroPersonajes, $textoJson);

        // Redirigimos a la misma página para evitar el reenvío del formulario al actualizar la página y para mostrar el mensaje de guardado
        header("Location: index.php?indice=" . $indice . "&guardado=1");
        exit;
    }

    // Si se ha guardado correctamente, mostramos un mensaje de confirmación
    if(isset($_GET["guardado"])){
        $mensajeGuardado = "Cambios guardados correctamente.";
    }

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
    <nav class="navegacion">
        <?php funcionNavegacion($personajes, $indice); ?>
    </nav>
    <main>
        <div class="formulario">
            <h2>Datos del Personaje</h2>
            <form method="post" action="">
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
                <button type="submit" name="accion" value="reiniciar">Reiniciar personajes</button>

                <div class="ultima-actualizacion">
                    <p><strong>Fecha de última actualización:</strong> <?php echo isset($fechaActualizacion) ? $fechaActualizacion : "No se han guardado cambios aún"; ?></p>
                </div>
            </form>
        </div>
        <?php 
            if(isset($mensajeGuardado)){
                echo "<div class='mensaje'>
                        <p>" . $mensajeGuardado . "</p>
                    </div>";
            }
        ?>

        <div class="errores">
            <?php 
                if(!empty($errores)){
                    echo "<ul>";
                    foreach($errores as $error){
                        echo "<li>" . $error . "</li>";
                    }
                    echo "</ul>";
                }
            ?>
        </div>

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

        <div class="lista-personajes">
            <h2>Lista de Personajes</h2>
            <ul>
                <?php 
                    foreach($personajes as $index => $personaje){
                        echo "<li>" . $personaje["nombre"] . " - " . $personaje["universo"] . " - " . $personaje["tipo"] . "</li>";
                    }
                ?>
            </ul>

        </div>
        
    </main>
    <footer>
        <p>&copy; 2026 Gestor de Personajes Mejorado. Todos los derechos reservados.</p>
    </footer>
</body>
</html>