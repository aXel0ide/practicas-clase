<?php
    function funcionNavegacion(array $personajes, int $indice){
        if($indice > 0){
            echo "<a href='?indice=" . ($indice - 1) . "'>Anterior</a>";
        }
        if($indice < count($personajes) - 1){
            echo "<a href='?indice=" . ($indice + 1) . "'>Siguiente</a>";

        }
    }

    function errores(){
        $errores = [];
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $nombre = trim($_POST["nombre"]);
            $universo = trim($_POST["universo"]);
            $tipo = trim($_POST["tipo"]);
            $poderes = trim($_POST["poderes"]);
            $anio = trim($_POST["anio"]);
            $imagen = trim($_POST["imagen"]);
            $activo = isset($_POST["activo"]);

            if(empty($nombre)){
                $errores[] = "El nombre no puede estar vacío";
            }

            if($anio == ""){
                $errores[] = "El año de creación no puede estar vacío";
            }

            if(!is_numeric($anio)){
                $errores[] = "El año de creación debe ser un número";
            }

            if($anio < 0){
                $errores[] = "El año de creación no puede ser negativo";
            }
        }
        return $errores;
    }

    function accionFormulario(array $personajes, int $indice, array $personajeActual){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $accion = $_POST["accion"];

            if($accion == "modificar"){
                $personajeActual["nombre"] = $_POST["nombre"] ?? $personajeActual["nombre"];
                $personajeActual["universo"] = $_POST["universo"] ?? $personajeActual["universo"];
                $personajeActual["tipo"] = $_POST["tipo"] ?? $personajeActual["tipo"];
                $personajeActual["poder"] = $_POST["poderes"] ?? $personajeActual["poder"];
                $personajeActual["anio"] = $_POST["anio"] ?? $personajeActual["anio"];
                $personajeActual["imagen"] = $_POST["imagen"] ?? $personajeActual["imagen"];
                $personajeActual["activo"] = isset($_POST["activo"]) ? true : false;
                
                $personajes[$indice] = $personajeActual;
            }

            if($accion == "añadir"){
                $nuevoPersonaje = [
                    "nombre" => $_POST["nombre"] ?? "",
                    "universo" => $_POST["universo"] ?? "",
                    "tipo" => $_POST["tipo"] ?? "",
                    "poder" => $_POST["poderes"] ?? "",
                    "anio" => $_POST["anio"] ?? 0,
                    "imagen" => $_POST["imagen"] ?? "",
                    "activo" => isset($_POST["activo"]) ? true : false
                ];
            
                $personajes[] = $nuevoPersonaje;
                $indice = count($personajes) - 1; // Ajustamos el índice al nuevo personaje
                $personajeActual = $nuevoPersonaje; // Mostramos el nuevo personaje

            }
        
            if($accion == "borrar"){
                array_splice($personajes, $indice, 1); // Eliminamos el personaje actual
                $indice = 0; // Volvemos al primer personaje
                $personajeActual = $personajes[$indice]; // Mostramos el primer personaje
            }
        }
        return [$personajes, $indice, $personajeActual];
    }
?>