<?php
    include_once "conexiones.php";

    $mensaje = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nombre  = $_POST["nombre"];
        $ciudad = $_POST["ciudad"];
        $email = $_POST["email"];
        $fecha_alta = $_POST["fecha_alta"];

        $sql = "insert into clientes(nombre, ciudad, email, fecha_alta)
                values
                ('$nombre', '$ciudad', '$email', '$fecha_alta')";
        
        if($conexion->query($sql) === TRUE){
            $mensaje = "Cliente insertado correctamente.";
        }else{
            $mensaje = "Error al insertar: " . $conexion->error;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Cliente</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <h1>Nuevo Cliente</h1>
    <form method="POST" action="">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" required>

        <label for="ciudad">Ciudad</label>
        <input type="text" name="ciudad" required>

        <label for="email">Email: </label>
        <input type="email" name="email" required>

        <label for="fecha_alta">Fecha de alta: </label>
        <input type="date" name="fecha_alta" required>

        <button type="submit">Guardar Cliente</button>

        <p><?php echo $mensaje ?></p>
    </form>
</body>
</html>
