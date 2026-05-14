<?php
    include_once('./funciones.php');

    /*
    EJEMPLO DE CLASES, OBJETOS Y MÉTODOS EN PHP

    // Creamos una clase para los personajes.
    // Una clase es un molde que nos permite crear objetos con las mismas propiedades y métodos.
    class Personaje{
        public string $nombre;
        public string $universo;
        public string $tipo;
        public string $poder;
        public int $anio;
        public bool $activo;
    }

    // Ceamos un objeto apartir de la clase Personaje.
    // Un objeto es una entidad creada usando una clase como molde(Personaje).
    // Tiene sus propias propiedades y puede guardar valores concretos.
    // Aquí $batman es un objeto creado a partir de la clase Personaje.
    $batman = new Personaje(); // new crea un nuevo objeto.
    $batman->nombre = 'Batman'; // Se utiliza -> para acceder a las propiedades del objeto y asignarles valores.
    $batman->universo = 'DC';
    $batman->tipo = 'Héroe';
    $batman->poder = 'Inteligencia, habilidades físicas y tecnológicas';
    $batman->anio = 1939;
    $batman->activo = true;
    // Cada objeto puede tener sus propios valores.

    // echo $batman->nombre; // Imprime "Batman"

    // Dentro de esta clase hay un método.
    // Un método es una función escrita dentro de una clase.
    //Sirve para que los objetos puedan hacer acciones o calcular cosas usando sus propios datos.
    class Personaje2{
        public string $nombre;
        public string $tipo;
        public bool $activo;

        // public function crea un método.
        public function mostrarEstado(){
            return $this->activo ? "Activo" : "Inactivo";
            // $this representa el objeto actual dentro de la clase.
            // Se usa para acceder a sus propiedades o métodos.
        }
    }

    */

    // Clase completa para la práctica
    class Personaje{
        public string $nombre;
        public string $universo;
        public string $tipo;
        public string $poder;
        public int $anio;
        public string $imagen;
        public bool $activo;

        // Constructor: se ejecuta al crear el objeto y rellena sus propiedades iniciales.
        public function __construct(string $nombre, string $universo, string $tipo, string $poder, int $anio, string $imagen, bool $activo){
            $this->nombre = $nombre;
            $this->universo = $universo;
            $this->tipo = $tipo;
            $this->poder = $poder;
            $this->anio = $anio;
            $this->imagen = $imagen;
            $this->activo = $activo;
        }

        public function mostrarEstado(){
            return $this->activo ? "Activo" : "Inactivo";
        }

        // Devuelve true si el personaje fue creado antes de 1980, si no devuelve false.
        public function esClasico(){
            return $this->anio < 1980;
        }

        // Devuelve un texto con la etiqueta "Tipo:" seguida del tipo del personaje.
        public function getEtiquetaTipo(){
            return "Tipo: " . $this->tipo;
        }

        public function frasePresentacion(){
            return "Hola, soy " . $this->nombre . " mayor " . $this->tipo . " del universo " . $this->universo . ".";
        }

        public function comprobarUniverso(){
            if($this->universo == "Marvel"){
                return "Soy un personaje de Marvel.";
            }
            if($this->universo == "DC"){
                return "Soy un personaje de DC.";
            }
            return "No soy ni de Marvel ni de DC.";
        }
    }

    // Creamos un array con varios objetos de la clase Personaje.
    $personajes = [
        new Personaje(
            "Batman",
            "DC",
            "Héroe",
            "Inteligencia, habilidades de combate, tecnología avanzada",
            1939,
            "./img/batman.jpg",
            true
        ),

        new Personaje(
            "Spider-Man",
            "Marvel",
            "Héroe",
            "Fuerza, agilidad, habilidades de trepador, sentido arácnido",
            1962,
            "./img/spiderman.jpg",
            true
        ),

        new Personaje(
            "Loki",
            "Marvel",
            "Villano",
            "Magia, manipulación, astucia",
            1949,
            "./img/loki.jpg",
            false
        ),

        new Personaje(
            "Superlópez",
            "Bruguera",
            "Héroe",
            "Superfuerza, supervelocidad, vuelo",
            1973,
            "./img/superlopez.jpg",
            true
        ),

        new Personaje(
            "Joker",
            "DC",
            "Villano",
            "Inteligencia, habilidades de combate, tecnología avanzada",
            1940,
            "./img/joker.jpg",
            false
        ),

        new Personaje(
            "Rhino",
            "Marvel",
            "Villano",
            "Fuerza, resistencia, armadura de rinoceronte",
            1975,
            "./img/rhino.jpg",
            true
        ),

        new Personaje(
            "Capitán América",
            "Marvel",
            "Héroe",
            "Fuerza, agilidad, habilidades de combate, escudo indestructible",
            1941,
            "./img/capitanamerica.jpg",
            true
        ),

        new Personaje(
            "Thanos",
            "Marvel",
            "Villano",
            "Fuerza, resistencia, inteligencia, manipulación de la realidad",
            1973,
            "./img/thanos.jpg",
            true
        ),

        new Personaje(
            "Harley Quinn",
            "DC",
            "Villano",
            "Habilidades de combate, uso de armas",
            1992,
            "./img/harleyquinn.jpg",
            false
        ),

        new Personaje(
            "Magneto",
            "Marvel",
            "Villano",
            "Control de metal, magnetismo, control sobre campos electromagnéticos",
            1963,
            "./img/magneto.jpg",
            true
        ),

        new Personaje(
            "Lex Luthor",
            "DC",
            "Villano",
            "Inteligencia, habilidades de combate, tecnología avanzada",
            1940,
            "./img/lexluthor.jpg",
            false
        ),

        new Personaje(
            "Iron Man",
            "Marvel",
            "Héroe",
            "Inteligencia, habilidades de combate, tecnología avanzada",
            1963,
            "./img/ironman.jpg",
            false
        )
    ];

    // Mostra personaje actual
    $indice = 0; // Indice del personaje actual

    // Si en la URL existe el parámetro "indice", usamos ese valor
    // para saber qué personaje mostrar.
    if(isset($_GET['indice'])){
        $indice = (int) $_GET['indice'];
    }

    // Si el indice es menor que 0, lo corregimos para que no salga del array
    if($indice < 0){
        $indice = 0;
    }

    // Si el indice es mayor que la últmia posición de array, lo ajustamos al último personaje
    if($indice >= count($personajes)){
        $indice = count($personajes) - 1;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nuevoPersonaje = new Personaje(
            $_POST['nombre'],
            $_POST['universo'],
            $_POST['tipo'],
            $_POST['poderes'],
            (int) $_POST['anio'],
            $_POST['imagen'],
            isset($_POST['activo'])
        );

        if($_POST["accion"] == "modificar"){
            $personajes[$indice] = $nuevoPersonaje;
        }

        if($_POST["accion"] == "añadir"){
            $personajes[] = $nuevoPersonaje; // Añade el nuevo personaje al final del array
            $indice = count($personajes) - 1; // Actualiza el índice para mostrar el nuevo personaje
        }
    }

    // Guardamos en esta variable el personaje que corresponde al índice elegido
    $personajeActual = $personajes[$indice];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <input type="text" name="nombre" id="nombre" value="<?php echo $personajeActual->nombre; ?>">

            <label for="universo">Universo</label>
            <input type="text" name="universo" id="universo" value="<?php echo $personajeActual->universo; ?>">

            <label for="tipo">Tipo</label>
            <input type="text" name="tipo" id="tipo" value="<?php echo $personajeActual->tipo; ?>">

            <label for="poderes">Poderes principales</label>
            <input type="text" name="poderes" id="poderes" value="<?php echo $personajeActual->poder; ?>">

            <label for="anio">Año de creación</label>
            <input type="number" name="anio" id="anio" value="<?php echo $personajeActual->anio; ?>">

            <label for="imagen">Imagen</label>
            <input type="text" name="imagen" id="imagen" value="<?php echo $personajeActual->imagen; ?>">

            <label>
                <input type="checkbox" name="activo" id="activo" <?php echo $personajeActual->activo ? "checked" : ""; ?>> Activo
            </label>

            <button type="submit" name="accion" value="modificar">Modificar</button>
            <button type="submit" name="accion" value="añadir">Añadir nuevo</button>
        </form>

        <div class="tarjeta <?php echo $personajeActual->activo ? "activo" : "inactivo"; ?>">
            <h2><?php echo $personajeActual->nombre; ?></h2>
            <img src="<?php echo $personajeActual->imagen; ?>" alt="Imagen de <?php echo $personajeActual->nombre; ?>">
            <p><strong>Universo:</strong> <?php echo $personajeActual->comprobarUniverso(); ?></p>
            <p><strong>Tipo:</strong> <?php echo $personajeActual->tipo; ?></p>
            <p><strong>Poderes:</strong> <?php echo $personajeActual->poder; ?></p>
            <p><strong>Año de creación:</strong> <?php echo $personajeActual->anio; ?></p>
            <p><strong>Activo:</strong> <?php echo $personajeActual->mostrarEstado(); ?></p>
            <?php 
                if($personajeActual->activo == true && $personajeActual->tipo == "Héroe"){
                    echo "<p>¡Es un héroe activo!</p>";
                }
                if($personajeActual->esClasico()){
                    echo "<p>¡Es un personaje clásico!</p>";
                }
            ?>
            <p><?php echo $personajeActual->frasePresentacion(); ?></p>
        </div>
        <div class="listado">
            <h2>Listado de Personajes</h2>
            <ul>
                <?php 
                    foreach($personajes as $personaje){
                        echo "<li>" . $personaje->nombre . " - " . $personaje->universo . " - " . $personaje->getEtiquetaTipo() . "</li>";
                    }
                ?>
            </ul>
        </div>
        <div class="resumen">
            <h2>Resumen</h2>
            <p>Total de personajes: <?php echo count($personajes); ?></p>
            <p>Personajes activos: <?php echo contarActivos($personajes); ?></p>
            <p>Personajes de Marvel: <?php echo contarPorUniverso($personajes, "Marvel"); ?></p>
            <p>Personajes de DC: <?php echo contarPorUniverso($personajes, "DC"); ?></p>
            <p>Personajes de Bruguera: <?php echo contarPorUniverso($personajes, "Bruguera"); ?></p>
        </div>
    </main>
    <footer>
        <p>&copy; 2025 Gestor de Personajes Frikis. Todos los derechos reservados.</p>
    </footer>
</body>
</html>