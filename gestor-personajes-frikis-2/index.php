<?php
    include_once('./funciones.php');

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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>

</body>
</html>