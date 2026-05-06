<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora Web</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <?php 
        $resultado = "";
        $error = "";
        $resto = 0;

        function tabla_multiplicar(int $n){
            $celdas = "";
            for($i = 1; $i <= 10; $i++){
                $resultado = $n * $i;
                $celdas .= 
                "<tr>
                    <td>" . $n . " * " . $i . "</td>
                    <td>" . $resultado . "</td>
                </tr>";
            }
            $tabla = 
            "<table class='tabla-multiplicar'>
                <thead>
                    <tr>
                        <th>Operación</th>
                        <th>Resultado</th>
                    </tr>
                </thead>
                <tbody>"
                    .$celdas."
                </tbody>
            </table>";
            return $tabla;
        }

        function calcular_iva(float $n){
            $total = $n * 1.21;
            return $total;
        }
        
        function factorial(int $n){
            $acumulado = 1;
            for($i = 1; $i <= $n; $i++){
                $acumulado = $acumulado * $i;
            }
            return $acumulado;
        }

        function primo(int $n){
            // Los números menores que 2 (0 y 1) no son primos.
            if($n < 2){
                $resultado = "El número " . $n . " no es primo.";
                return $resultado;
            }
            // Recorremos desde 2 hasta n-1 para comprobar posibles divisores.
            for($i = 2; $i < $n; $i++){
                // Si n es divisible entre i (resto 0), entonces no es primo..
                if($n % $i == 0){
                    $resultado = "El número " . $n . " no es primo.";
                    return $resultado;
                }
            }
            // Si no se ha encontrado ningún divisor, el número es primo.
            $resultado = "El número " . $n . "  es primo.";
            return $resultado;
        }

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $num1 = $_POST["num1"];
            $num2 = $_POST["num2"];
            $operacion = $_POST["operacion"];

            if($num1 === ""){
                $error = "Falta el primer número";
            }else{
                if($operacion !== "factorial" && $num2 === ""){
                    $error = "Falta el segundo número";
                }else{
                    switch ($operacion){
                        case "sumar":
                            $resultado = $num1 + $num2;
                            break;
                        case "restar":
                            $resultado = $num1 - $num2;
                            break;
                        case "multiplicar":
                            $resultado = $num1 * $num2;
                            break;
                        case "dividir":
                            if($num2 == 0){
                                $error = "No se puede dividir entre cero.";
                            }else{
                                $resultado = $num1 / $num2;
                                $resto = $num1 % $num2;
                            }
                            break;
                        case "factorial":
                            if(!is_numeric($num1) || $num1 < 0 || floor($num1) != $num1){
                                $error = "El factorial solo admite enteros no negativos.";
                            }else{
                                $resultado = factorial($num1);
                            }
                            break;
                        case "potencia":
                            $resultado = pow($num1, $num2);
                            break;
                        case "doble":
                            $num2 = 2;
                            $resultado = $num1 * $num2;
                            break;
                        case "cuadrado":
                            $resultado = $num1 * $num1;
                            break;
                        case "raiz_cuadrada":
                            $resultado = sqrt($num1);
                            break;
                        case "primo":
                            $resultado = primo($num1);
                            break;
                        case "tabla":
                            $resultado = tabla_multiplicar($num1);
                            break;
                        case "iva":
                            $resultado = calcular_iva($num1);
                            break;
                        default:
                            $error = "Operador no válido.";
                            break;
                    }
                }
            }
        }
    ?>
    <header>
        <h1>Calculadora Web Axelandre</h1>
        <p>Esta página presenta la mejor calculadora tanto normal como científica, perfecta para realizar hasta las operaciones más complicadas.</p>
        <div class="instrucciones">
            <h3>Instrucciones de uso:</h3>
            <p>Deberás escribir uno o dos números (operaciones como cuadrado, raíz cuadrada, primo, tabla de multiplicar o calcular el IVA)</p>
            <p>no necesitarán de un segundo número. Una vez pasados los dos/un número elegirás la operación que queiras realizar y el resultado</p>
            <p>se te mostrará por pantalla.</p>
        </div>
    </header>
    <div class="contenedor">
        <h2>Calculadora web</h2>

        <div class="header-calculadora">
            <div class="tipo-calculadora">
                <h3>Tipo de Calculadora</h3>
                <button type="button" id="normal" class="activo">Calculadora Normal</button>
                <button type="button" id="cientifica">Calculadora Científica</button>
            </div>

            <img src="./calculadora.png" alt="Icono de Calculadora">
        </div>

        <form method="post" id="formularioCalculadora">
            <label for="num1">Primer Número</label>
            <input type="number" step="any" name="num1" id="num1">

            <label for="num2">Segundo Número</label>
            <input type="number" step="any" name="num2" id="num2">

            <label>Operación</label>
            <div class="operaciones-simples">
                <button type="submit" name="operacion" value="sumar">Sumar</button>
                <button type="submit" name="operacion" value="restar">Restar</button>
                <button type="submit" name="operacion" value="multiplicar">Multiplicar</button>
                <button type="submit" name="operacion" value="dividir">Dividir</button>
            </div>
            <div class="operaciones-complejas oculto" id="operaciones-complejas">
                <button type="submit" name="operacion" value="factorial">Factorial</button>
                <button type="submit" name="operacion" value="potencia">Potencia</button>
                <button type="submit" name="operacion" value="doble">Doble</button>
                <button type="submit" name="operacion" value="cuadrado">Cuadrado</button>

                <button type="submit" name="operacion" value="raiz_cuadrada">Raíz cuadrada</button>
                <button type="submit" name="operacion" value="primo">Primo</button>
                <button type="submit" name="operacion" value="tabla">Tabla x 10</button>
                <button type="submit" name="operacion" value="iva">Calcular IVA</button>
            </div>
        </form>
        <button type="button" id="borrar">Borrar</button>
    </div>
    <?php if($error != "") {?>
        <div class="resultado">
            <p><?php echo $error ?></p>
        </div>
    <?php } ?>

    <?php if($resultado !== "" && $error == ""){ ?>
        <div class="resultado">
            <?php if($operacion == "dividir"){ ?>
                <p>
                    Resultado: <?php echo number_format($resultado, 2, ",", "."); ?>
                    y el resto es <?php echo $resto; ?>
                </p>
            <?php }else{ ?>
                <?php if(is_numeric($resultado)){ ?>
                    <?php if($operacion == "iva"){ ?>
                        <p>Reultado: <?php echo number_format($resultado, 2, ",", ".") . "€"; ?></p>
                    <?php }else{ ?>
                        <p>Resultado: <?php echo number_format($resultado, 2, ",", "."); ?></p>
                    <?php } ?>
                <?php }else{ ?>
                    <p><?php echo $resultado; ?></p>
                <?php } ?>
            <?php } ?>
        </div>
    <?php } ?>
    <footer>
        <p>Todos los derechos reservados a Axelandre el mejor programador del mundo.</p>
        <p>Esta página contiene derechos de Copyright &copy; .</p>
        <p>Redes Sociales: Instagram: axel0ide X: axel0ide YouTube: aXl0ide</p>
    </footer>
    <script src="./script.js"></script>
</body>
</html>