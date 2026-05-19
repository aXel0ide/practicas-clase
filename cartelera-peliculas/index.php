<?php
    session_start();
    include_once "./funciones.php";

    $peliculas = [
        [
            "titulo" => "Batman",
            "universo" => "DC",
            "anio" => 2022,
            "protagonista" => "Batman",
            "imagen" => "./img/batman.jpg",
            "descripcion" => "Película oscura y visual sobre el icónico superhéroe de Gotham City, Batman, que lucha contra el crimen y la corrupción en su ciudad."
        ],
        [
            "titulo" => "Spiderman",
            "universo" => "Marvel",
            "anio" => 2017,
            "protagonista" => "Spiderman",
            "imagen" => "./img/spiderman.jpg",
            "descripcion" => "Película de acción y aventura sobre el joven Peter Parker, quien adquiere poderes arácnidos y se convierte en el superhéroe Spiderman para proteger a Nueva York."
        ],
        [
            "titulo" => "Superman",
            "universo" => "DC",
            "anio" => 2022,
            "protagonista" => "Superman",
            "imagen" => "./img/superman.jpg",
            "descripcion" => "Película épica y emocionante sobre el superhéroe Superman, quien lucha por la justicia y la verdad mientras protege a la humanidad de amenazas cósmicas."
        ],
        [
            "titulo" => "Superlópez",
            "universo" => "Español",
            "anio" => 2022,
            "protagonista" => "Superlópez",
            "imagen" => "./img/superlopez.jpg",
            "descripcion" => "Película de comedia y acción sobre el detective Superlópez, quien resuelve casos y lucha contra el crimen en su ciudad."
        ],
        [
            "titulo" => "Mortadelo y Filemón",
            "universo" => "Español",
            "anio" => 2022,
            "protagonista" => "Mortadelo y Filemón",
            "imagen" => "./img/mortadelo-filemon.jpg",
            "descripcion" => "Película de comedia y aventura sobre los agentes secretos Mortadelo y Filemón, quienes se embarcan en misiones hilarantes y absurdas para salvar el mundo de amenazas cómicas."
        ]
    ];

    $indice = 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartelera de Películas</title>
</head>
<body>
    <header>
        <h1>Cartelera de Películas</h1>
        <p>Bienvenido a la cartelera de películas más actualizada. O eso es lo que se dice.</p>
    </header>
    <main>
        <div class="peliculas">
            <?php foreach ($peliculas as $pelicula): ?>
                <article class="tarjeta">
                    <h2><?php echo $pelicula["titulo"]; ?></h2>
                    <img src="<?php echo $pelicula["imagen"]; ?>" alt="<?php echo $pelicula["titulo"]; ?>">
                    <p><strong>Universo:</strong> <?php echo $pelicula["universo"]; ?></p>
                    <p><strong>Año: </strong> <?php echo $pelicula["anio"]; ?></p>
                    <p><?php echo $pelicula["descripcion"]; ?></p>
                </article>
            <?php endforeach; ?>
        </div>

        <div class="formulario">
            <h2>Añadir una nueva película</h2>
            <form action="./guardar.php" method="post" class="formulario-pelicula">
                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo">

                <label for="universo">Universo</label>
                <select name="universo" id="universo">
                    <option value="Marvel">Marvel</option>
                    <option value="DC">DC</option>
                    <option value="Español">Español</option>
                </select>

                <label for="anio">Año</label>
                <input type="number" id="anio" name="anio">

                <label for="protagonista">Protagonista</label>
                <input type="text" id="protagonista" name="protagonista">

                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion"></textarea>

                <button type="submit">Añadir Película</button>
            </form>
        </div>
    </main>
    <footer>
        <p>&copy; 2026 Cartelera de Películas. Todos los derechos reservados.</p>
    </footer>
</body>
</html>