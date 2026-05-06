<?php
    function validarNombre(string $nombre){
        return trim($nombre) != "" && strlen(trim($nombre)) >= 3;
    }

    function validarCorreo(string $correo){
        return filter_var($correo, FILTER_VALIDATE_EMAIL);
    }

    function validarEdad(string $edad){
        return $edad != "" || $edad >= 1 && $edad <= 120 ;
    }

    function validarCantidad(string $cantidad){
        return $cantidad != "" && $cantidad >= 1 && $cantidad <=6;
    }

    function validarDia(string $dia){
        return $dia != "";
    }

    function calcularPrecioBase(string $tipoEntrada){
        switch ($tipoEntrada){
            case "general":
                return 12;
            case "infantil":
                return 8;
            case "premium":
                return 20;
            default:
                return 0;
        }
    }

    function aplicarSuplementoDia(string $dia){
        if($dia == "sabado" || $dia == "domingo"){
            return 2;
        }
        return 0;
    }

    function calcularTotal(string $tipoEntrada, int $cantidad, string $dia){
    $precioBase = calcularPrecioBase($tipoEntrada);
    $suplemento = aplicarSuplementoDia($dia);
    $precioUnitario = $precioBase + $suplemento;
    $total = $precioUnitario * $cantidad;
    return $total;
    }
?>