<?php
    session_start();
    include_once ("./funciones.php");

    $actuacionesIniciales = [
        [
            "id" => "A001",
            "artista" => "Rusowsky",
            "estilo" => "Bedroom pop, R&B Alternativo, Pop Experimental",
            "dia" => "Viernes",
            "escenario" => "El Valle",
            "franja" => "21:00",
            "duracion" => 60,
            "imagen" => "./img/rusowsky.jpg",
            "audio" => "./media/rusowsky.mp3",
            "descripcion" => "Concierto principal del festival con luces y grandes efectos visuales."
        ],
        [
            "id" => "A002",
            "artista" => "Abhir",
            "estilo" => "R&B Alternativo, Trap/Rap, Pop Experimental",
            "dia" => "Viernes",
            "escenario" => "El Valle",
            "franja" => "22:00",
            "duracon" => 60,
            "imagen" => "./img/abhir.jpg",
            "audio" => "./media/abhir.mp3",
            "descripcion" => "El artista canario vuelve a visitarnos para animar y romperla con su nuevo disco ULTRASWAN."
        ]
    ];

    $horarioInicial = [
        "Viernes" => [
            "El Valle" => [
                "18:00" => null,
                "19:00" => null,
                "20:00" => null,
                "21:00" => null,
                "22:00" => null,
                "23:00" => null,
                "00:00" => null,
                "01:00" => null,
                "02:00" => null,
                "03:00" => null,
                "04:00" => null,
                "05:00" => null,
                "06:00" => null,
                "08:00" => null
            ],
            "El Bosque" =>[
                "18:00" => null,
                "19:00" => null,
                "20:00" => null,
                "21:00" => null,
                "22:00" => null,
                "23:00" => null,
                "00:00" => null,
                "01:00" => null,
                "02:00" => null,
                "03:00" => null,
                "04:00" => null,
                "05:00" => null,
                "06:00" => null,
                "08:00" => null 
            ],
            "La Carpa" => [
                "18:00" => null,
                "19:00" => null,
                "20:00" => null,
                "21:00" => null,
                "22:00" => null,
                "23:00" => null,
                "00:00" => null,
                "01:00" => null,
                "02:00" => null,
                "03:00" => null,
                "04:00" => null,
                "05:00" => null,
                "06:00" => null,
                "08:00" => null
            ]
        ],
        "Sábado" => [
            "El Valle" => [
                "18:00" => null,
                "19:00" => null,
                "20:00" => null,
                "21:00" => null,
                "22:00" => null,
                "23:00" => null,
                "00:00" => null,
                "01:00" => null,
                "02:00" => null,
                "03:00" => null,
                "04:00" => null,
                "05:00" => null,
                "06:00" => null,
                "08:00" => null
            ],
            "El Bosque" =>[
                "18:00" => null,
                "19:00" => null,
                "20:00" => null,
                "21:00" => null,
                "22:00" => null,
                "23:00" => null,
                "00:00" => null,
                "01:00" => null,
                "02:00" => null,
                "03:00" => null,
                "04:00" => null,
                "05:00" => null,
                "06:00" => null,
                "08:00" => null 
            ],
            "La Carpa" => [
                "18:00" => null,
                "19:00" => null,
                "20:00" => null,
                "21:00" => null,
                "22:00" => null,
                "23:00" => null,
                "00:00" => null,
                "01:00" => null,
                "02:00" => null,
                "03:00" => null,
                "04:00" => null,
                "05:00" => null,
                "06:00" => null,
                "08:00" => null
            ]
        ],
        "Domingo" => [
            "El Valle" => [
                "18:00" => null,
                "19:00" => null,
                "20:00" => null,
                "21:00" => null,
                "22:00" => null,
                "23:00" => null,
                "00:00" => null,
                "01:00" => null,
                "02:00" => null,
                "03:00" => null,
                "04:00" => null,
                "05:00" => null,
                "06:00" => null,
                "08:00" => null
            ],
            "El Bosque" =>[
                "18:00" => null,
                "19:00" => null,
                "20:00" => null,
                "21:00" => null,
                "22:00" => null,
                "23:00" => null,
                "00:00" => null,
                "01:00" => null,
                "02:00" => null,
                "03:00" => null,
                "04:00" => null,
                "05:00" => null,
                "06:00" => null,
                "08:00" => null 
            ],
            "La Carpa" => [
                "18:00" => null,
                "19:00" => null,
                "20:00" => null,
                "21:00" => null,
                "22:00" => null,
                "23:00" => null,
                "00:00" => null,
                "01:00" => null,
                "02:00" => null,
                "03:00" => null,
                "04:00" => null,
                "05:00" => null,
                "06:00" => null,
                "08:00" => null
            ]
        ]
    ];

    $ficheroActuaciones = "./actuaciones.json";
    $ficheroHorario = "./horario.json";


    // Metemos las actuaciones de la sesión en una variable para facilitar el uso
    $actuaciones = cargarDatosSesion("actuaciones", $ficheroActuaciones, $actuacionesIniciales);
    $horarios = cargarDatosSesion("horarios", $ficheroHorario, $horarioInicial);
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <header>
        <h1>Riverland Asturias</h1>
    </header>
    <nav>

    </nav>
    <main>

    </main>
    <footer>

    </footer>
    <script src="./script.js"></script>
</body>
</html>