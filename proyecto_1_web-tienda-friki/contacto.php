<?php
    require "./config/conexion.php";

    $mensaje_ok = null;
    $errores = [];

    $sql_productos = "
        select id, nombre
        from productos
        order by nombre";
    
    $productos = $conexion->query($sql_productos);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nombre = trim($_POST["nombre_cliente"] ?? "");
        $email = trim($_POST["email"] ?? "");
        $producto_id = $_POST["producto_id"] ?? "";
        $mensaje = trim($_POST["mensaje"] ?? "");

        if($nombre == ""){
            $errores[] = "El nombre es obligatorio.";
        }
        if($email == ""){
            $errores[] = "El email es obligatorio.";
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errores[] = "El email no tiene un formato valido.";
        }

        if($mensaje == ""){
            $errores[] = "El mensaje es obligatorio";
        }

        if(empty($errores)){
            if(is_numeric($producto_id)){
                $producto_id = (int)$producto_id;

                $sql_insert = "
                    insert into consultas
                    (nombre_cliente, email, producto_id, mensaje, fecha) values
                    (?, ?, ?, ?, now())";

                $stmt = $conexion->prepare($sql_insert);
                $stmt->bind_param("ssis", $nombre, $email, $producto_id, $mensaje);
            }else{
                $sql_insert = "
                    insert into consultas
                    (nombre_cliente, email, producto_id, mensaje, fecha) values
                    (?, ?, null, ?, now())";

                $stmt = $conexion->prepare($sql_insert);
                $stmt->bind_param("sss", $nombre, $email, $mensaje);
            }

            if($stmt->execute()){
                $mensaje_ok = "Consulta guardada correctamente.";
            }else{
                $errores[] = "No se ha podido guardar la consulta";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacta con Nosotros</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/styles-contacto.css">
</head>
<body>
    <header>
        <h1>Contacta con Nosotros</h1>
    </header>
    <nav>
        <a href="./index.php">Inicio</a>
        <a href="./productos.php">Productos</a>
        <a href="./videojuegos.php">Videojuegos</a>
        <a href="./novedades.php">Novedades</a>
        <a href="./contacto.php">Contacto</a>
    </nav>
    <main>
        <section class="datos-contacto">
            <h2>Datos de contacto</h2>
            <address>
                <p><strong>Tienda Friki Web</strong></p>
                <p>Calle de los Comics, 17 - 40001 Segovia</p>
                <p>Telefono: <a href="tel:+34921999000">921 999 000</a></p>
                <p>Email general: <a href="mailto:info@tiendafrikiweb.local">info@tiendafrikiweb.local</a></p>
                <p>Pedidos: <a href="mailto:pedidos@tiendafrikiweb.local">pedidos@tiendafrikiweb.local</a></p>
                <p>Soporte: <a href="mailto:soporte@tiendafrikiweb.local">soporte@tiendafrikiweb.local</a></p>
            </address>

            <h3>Horario</h3>
            <p>Lunes a viernes: 10:00 - 14:00 y 17:00 - 20:30</p>
            <p>Sabados: 10:30 - 14:00</p>

            <h3>Redes sociales</h3>
            <ul class="redes-sociales">
                <li>Instagram: <a href="#">@tiendafrikiweb</a></li>
                <li>Facebook: <a href="#">Tienda Friki Web</a></li>
                <li>X / Twitter: <a href="#">@TFrikiWeb</a></li>
                <li>TikTok: <a href="#">@tiendafrikiweb</a></li>
            </ul>
        </section>

        <section>
            <h2>Contacta con nosotros mediante este formulario</h2>
            <form action="" method="post" id="formulario-contacto" class="formulario">
                <label for="nombre_cliente">Nombre: </label>
                <input type="text" name="nombre_cliente" id="nombre_cliente" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>

                <label for="producto_id">Producto de interes:</label>
                <select name="producto_id" id="producto_id">
                    <option value="">Consulta general</option>
                    <?php while ($p = $productos->fetch_assoc()){ ?>
                        <option value="<?php echo $p["id"]; ?>"><?php echo htmlspecialchars($p["nombre"]); ?></option>
                    <?php } ?>
                </select>
                
                <label for="mensaje">Mensaje:</label>
                <textarea name="mensaje" id="mensaje" required></textarea>

                <button type="submit">Enviar consulta</button>
            </form>
        </section>
        <?php if(!empty($errores)){ ?>
            <section>
                <div class="error" role="alert">
                    <?php foreach($errores as $error){ ?>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    <?php } ?>
                </div>
            </section>
        <?php } ?>
        
        <?php if($mensaje_ok != ""){ ?>
            <section>
                <div class="ok" role="status">
                    <p><?php echo htmlspecialchars($mensaje_ok); ?></p>
                </div>
            </section>
        <?php } ?>
    </main>
    <footer>
        <p>Tienda Friki Web - Proyecto PHP y MariaDB</p>
    </footer>
    <script src="./assets/js/script.js"></script>
</body>
</html>
