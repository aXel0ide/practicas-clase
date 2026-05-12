<?php
    function funcionNavegacion(array $personajes, int $indice){
        if($indice > 0){
            echo "<a href='?indice=" . ($indice - 1) . "'>Anterior</a>";
        }
        if($indice < count($personajes) - 1){
            echo "<a href='?indice=" . ($indice + 1) . "'>Siguiente</a>";

        }
    }
    
    function contarActivos(array $personajes){
        $contador = 0;
        foreach($personajes as $personaje){
            if($personaje["activo"]){
                $contador++;
            }
        }
        return $contador;
    }

    function contarPorTipo(array $personajes, string $tipoBuscado){
        $contador = 0;
        foreach($personajes as $personaje){
            if($personaje["tipo"] == $tipoBuscado){
                $contador++;
            }
        }
        return $contador;
    }

    function obtenerPrimerNombre(array $personajes){
        return $personajes[0]["nombre"] ?? "No hay personajes";
    }

    function personajesUniverso(array $personajes, string $universoBuscado){
        // Array para almacenar los personajes encontrados
        $resultados = [];
        // Contador para el número de personajes encontrados
        $contador = 0;

        // Recorremos el array de personajes
        foreach($personajes as $personaje){
            // Si el universo del personaje coincide con el buscado, lo añadimos a los resultados
            if($personaje["universo"] == $universoBuscado){
                // Añadimos el personaje al array de resultados. OJO: $personaje es un array, por lo que $resultado será un array de arrays.
                // Cada personaje tiene los mismos campos (nombre, universo, tipo, poderes, imagen, activo),
                // por lo que el resultado tendrá la misma estructura que el array original de personajes, pero solo con los personajes que coincidan
                // con el universo buscado.
                $resultados[] = $personaje;
                $contador++;
            }
        }
        return ["contador" => $contador, "personajes" => $resultados];
    }
?>