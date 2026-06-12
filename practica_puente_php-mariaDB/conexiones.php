<?php
    // Base de datos alojada en el propio equipo
    $servidor = "localhost";
    // Usuario habitual en XAMPP si no se ha cambiado
    $usuario = "root";
    // Contraseña vacía si no se ha configurado
    $contrasena = "";
    // Base de datos seleccionada
    $basedatos = "tienda_comic";

    // Crea la conexión
    $conexion = new mysqli($servidor, $usuario, $contrasena, $basedatos);
    // Si falla el programa se detiene con un mensaje
    if($conexion->connect_error){
        die("Error de conexion: " . $conexion->connect_error);
    }

    // Ayuda a monstrar bien los acentos y caracteres especiales
    $conexion->set_charset("utf8");
?>
