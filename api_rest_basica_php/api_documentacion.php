<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentación sobre la API</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <header>
        <h1>Documentación Sobre la API</h1>
    </header>
    <main class="contenedor-inicio">
        <div class="contenedor">
            <h2>Endpoints Disponibles</h2>
            <p>
                Realmente, aunque se hable de endpoits en plural, el único que existe actualmente es 
                api_peliculas.php, ya que es la única URL a la que se le hace una petición para obtener
                información sobre las películas.
            </p>
        </div>
        <div class="contenedor">
            <h2>Parámetros Admintidos</h2>
            <p>
                Los parámetros que acepta la API, que hacen que cambie la consulta son:
                <ul>
                    <li><b>Universo</b></li>
                    <li><b>Año mínino</b></li>
                    <li><b>Formato</b></li>
                    <li><b>Valoración mínima</b></li>
                </ul>
            </p>
        </div>
        <div class="contenedor">
            <h2>Ejemplos de URLs</h2>
            <p>
                Algunos ejemplos de las URls que se pueden usar para filtrar son:
            </p>
            <ol>
                <li><a href="http://localhost/practicas-clase/api_rest_basica_php/api_peliculas.php">http://localhost/practicas-clase/api_rest_basica_php/api_peliculas.php</a></li>
                <li><a href="http://localhost/practicas-clase/api_rest_basica_php/api_peliculas.php?universo=Marvel">http://localhost/practicas-clase/api_rest_basica_php/api_peliculas.php?universo=Marvel</a></li>
                <li><a href="http://localhost/practicas-clase/api_rest_basica_php/api_peliculas.php?min_anio=2020">http://localhost/practicas-clase/api_rest_basica_php/api_peliculas.php?min_anio=2020</a></li>
            </ol>
            <p>
                Haciendo click a los enlaces se mostrarán los datos que almacena la API en formato
                JSON, sin filtrar como en el numero <b>1</b> o sin filtrar como en los 2 otros ejemplos <b>2 y 3</b>.
            </p>
    </main>
</body>
</html>