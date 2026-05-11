<?php
    function contarDisponible(array $videoclub){
        $contador = 0;
        foreach($videoclub as $pelicula){
            if($pelicula["disponible"]){
                $contador++;
            }
        }
        return $contador;
    }

    function calcularPrecioMedio(array $videoclub){
        $suma = 0;
        foreach($videoclub as $pelicula){
            $suma += $pelicula["precio"];
        }
        return $suma / count($videoclub);
    }

    function obtenerMejorPuntuada(array $videoclub){
        $mejor = $videoclub[0];
        foreach($videoclub as $pelicula){
            if($pelicula["puntuacion"] > $mejor["puntuacion"]){
                $mejor = $pelicula;
            }
        }
        return $mejor;
    }

    function obtenerMasBarata(array $videoclub){
        $barata = $videoclub[0];
        foreach($videoclub as $pelicula){
            if($pelicula["precio"] < $barata["precio"]){
                $barata = $pelicula;
            }
        }
        return $barata;
    }

    function precioGeneral(array $videoclub){
        $total = 0;
        foreach($videoclub as $pelicula){
            $total += $pelicula["precio"];
        }
        return $total;
    }

    function mejorValoradas(array $videoclub){
        $mejorValoradas = "";
        foreach($videoclub as $pelicula){
            if($pelicula["puntuacion"] >= 8){
                $mejorValoradas .=  $pelicula["titulo"] . " ";
            }
        }
        return $mejorValoradas;
    }

    function crearLista(array $videoclub){
        foreach($videoclub as $pelicula){
            echo "<li>" . $pelicula["titulo"] . "</li>";    
        }
    }
?>