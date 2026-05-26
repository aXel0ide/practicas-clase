<?php
    // Función para cargar los datos de los JSON si existiera o los del array
    function cargarDatosSesion($claveSesion, $fichero, $datosIniciales){
        // Comprueba si no hay datos en la sesión
        if(!isset($_SESSION[$claveSesion])){
            // Lee el contenido del JSON y lo guarda
            $contenido = file_get_contents($fichero);
            // Decodifica el contenido JSON y lo convierte en un array asociativo
            $datosJSON = json_decode($contenido, true);

            if(is_array($datosJSON)){
                // Si el JSON es un array válido lo guarda en la sesión
                $_SESSION[$claveSesion] = $datosJSON;
            }else{
                // Si no es válido usa los datos iniciales
                $_SESSION[$claveSesion] = $datosIniciales;
            }
        }else{
            // Si no existe el JSON usa los datos iniciales
            $_SESSION[$claveSesion] = $datosIniciales;
        }
        return $_SESSION[$claveSesion];
    }
?>

