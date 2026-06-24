<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - API REST básica</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <header>
        <h1>Mini aplicación con API REST básica</h1>
        <p>Práctica de UF1846: servicio, parámetros GET, filtros y consumo de datos.</p>
    </header>
    <main class="contenedor-inicio">
        <a class="boton" href="./api_peliculas_segura.php?clave=curso2026">Ver API completa</a>
        <a class="boton" href="./api_peliculas_segura.php?clave=clave_lectura2026&universo=Marvel">API filtrada por Marvel</a>
        <a class="boton" href="./api_peliculas_segura.php?clave=curso2026&min_anio=2020">API desde 2020</a>
        <a class="boton" href="./catalogo_seguro.php">Ver catálogo visual</a>
        <a class="boton" href="./api_documentacion.php">Documentación de la API</a>
    </main>
</body>
</html>