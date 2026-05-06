<?php
    include_once "funciones.php";

    $errores = [];
    $resultado = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nombre = $_POST["nombre"];
        $correo = $_POST["correo"];
        $edad = $_POST["edad"];
        $tipoEntrada = $_POST["tipoEntrada"];
        $cantidad = $_POST["cantidad"];
        $dia = $_POST["dia"] ?? "";
        $observaciones = $_POST["observaciones"];

        if(!validarNombre($nombre)){
            $errores[] = "El nombre no es válido.";
        }

        if(!validarCorreo($correo)){
            $errores[] = "El correo electrónico no es válido.";
        }

        if(!validarEdad($edad)){
            $errores[] = "La edad no es correcta.";
        }

        if(!validarCantidad($cantidad)){
            $errores[] = "La cantidad de entradas no puede ser inferior a 1 ni superior a 6.";
        }

        if(!validarDia($dia)){
            $errores[] = "Debes seleccionar un día de asistencia.";
        }

        if($tipoEntrada == "infantil" && $edad > 12){
            $errores[] = "La entrada infantil sólo se permite hasta los 12 años.";
        }

        if(count($errores) === 0){
            $precioTotal = calcularTotal($tipoEntrada, $cantidad, $dia);
            $resultado = "Reserva correcta. Total: " . number_format($precioTotal, 2, ",", ".") . " €.";
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva para el Salón del Cómic</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <header>
        <h1>Haz tu reserva para <u>El Salón del Cómic</u></h1>
        <p>En esta página podrás reserval el día que tu quieras (si está disponible) para asistir al evento más esperado <u>El Salón del Cómic</u>.</p>
    </header>
    <main>
        <div class="formulario">
            <h2>Reserva web para El Salón del Cómic</h2>
            <form method="post" action="">
                <label for="nombre">Nombre Completo</label>
                <input type="text" name="nombre" id="nombre">

                <label for="correo">Correo electrónico</label>
                <input type="email" name="correo" id="correo">

                <label for="edad">Edad</label>
                <input type="number" name="edad" id="edad" min="1" max="120">

                <label for="tipoEntrada">Tipo de Entrada</label>
                <select name="tipoEntrada" id="tipoEntrada">
                    <option value="general">General</option>
                    <option value="infantil">Infantil</option>
                    <option value="premium">Premium</option>
                </select>

                <label for="cantidad">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad">

                <p>Día de asistencia:</p>
                <label>
                    <input type="radio" name="dia" value="viernes">Viernes
                </label>


                <label>
                    <input type="radio" name="dia" value="sabado">Sábado
                </label>

                <label>
                    <input type="radio" name="dia" value="domingo">Domingo
                </label>

                <label for="observaciones">Observaciones</label>
                <textarea name="observaciones" id="observaciones" rows="10" placeholder="Escribe las observaciones que sean necesarias."></textarea>

                <button type="submit">Enviar Reserva</button>
            </form>
        </div>
    <?php if(count($errores) > 0){ ?>
        <div class="resultado error">
            <h2>Se han producido errores en tu reserva.</h2>
            <ul>
            <?php foreach($errores as $error){ ?>
                <li><?php echo $error; ?></li>
            <?php } ?>
            </ul>
        </div>
    <?php } ?>
    <?php if($resultado != ""){ ?>
        <div class="resultado">
            <h2>Resumen de la reserva</h2>
            <p><?php echo $resultado; ?></p>
            <p>Nombre: <?php echo $nombre; ?></p>
            <p>Correo: <?php echo $correo; ?></p>
            <p>Tipo de entrada: <?php echo $tipoEntrada; ?></p>
            <p>Día: <?php echo $dia; ?></p>
            <p>Cantidad: <?php echo $cantidad; ?></p>
        </div>
    <?php } ?>
    </main>
    <footer>
        <p>Página creada por el increible aXel0ide, muchas gracias por su atención JAJA.</p>
        <p>Esta página contiene derechos de Copyright &copy; .</p>
    </footer>
</body>
</html>