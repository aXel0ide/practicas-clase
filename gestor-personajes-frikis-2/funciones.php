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
            if($personaje->activo){
                $contador++;
            }
        }
        return $contador;
    }

    function contarPorUniverso(array $personajes, string $universo){
        $contador = 0;
        foreach($personajes as $personaje){
            if($personaje->universo == $universo){
                $contador++;
            }
        }
        return $contador;
    }
?>