<?php
    function validarNombre(string $nombre){
        return trim($nombre) != "" && strlen(trim($nombre)) >= 3;
    }

    function validarCorreo(string $correo){
        return filter_var($correo, FILTER_VALIDATE_EMAIL);
    }

    function validarEdad(string $edad){
        return $edad != "" && $edad >= 1 && $edad <= 120;
    }

    function validarTelefono(string $telefono){
        return $telefono != "" && is_numeric($telefono) && strlen($telefono) == 9; 
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

    function comprobarCodigo(string $cod, array $codigos){
        foreach($codigos as $codigo){
            if(trim($cod) == $codigo){
                return true;
            }
        }
        return false;
    }

    function calcularTotal(string $tipoEntrada, int $cantidad, string $dia){
        if($tipoEntrada == "premium" && $dia == "sabado"){
            $precioBase = 25;
            $suplemento = aplicarSuplementoDia($dia);
            $precioUnitario = $precioBase + $suplemento;
        }else{
            $precioBase = calcularPrecioBase($tipoEntrada);
            $suplemento = aplicarSuplementoDia($dia);
            $precioUnitario = $precioBase + $suplemento;
        }

        $total = $precioUnitario * $cantidad;

        if($cantidad >= 4){
            $total = $total * 0.95;
        }

        if($cantidad >= 5){
            $total = $total * 0.90;
        }
        
        return $total;
    }
?>
