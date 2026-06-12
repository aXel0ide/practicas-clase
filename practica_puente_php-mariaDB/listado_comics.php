<?php
    /* Esta página conectará con la base de datos, hará una consulta real con `INNER JOIN` y mostrará el resultado en una tabla HTML */

    include_once "conexiones.php";

    $sql = 
        "select c.titulo_comic as 'titulo', c.precio as 'precio', c.stock as 'stock',
        e.nombre as 'editorial', a.nombre as 'autor'
        from comics as c inner join editoriales as e
        on c.id_editorial = e.id_editorial inner join comic_autoria as ca
        on c.id_comic = ca.id_comic inner join autores as a
        on ca.id_autor = a.id_autor
        where ca.rol = 'Guionista'
        order by c.titulo_comic asc;";

    $resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Cómics</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <h1>Listado de Cómics</h1>
    <table>
        <tr>
            <th>Titulo</th>
            <th>Editorial</th>
            <th>Autor</th>
            <th>Precio</th>
            <th>Stock</th>
        </tr>
        <?php 
            if($resultado->num_rows >0){
                while($fila = $resultado->fetch_assoc()){
                    echo
                    "<tr>
                        <td>" . $fila["titulo"] . "</td>
                        <td>" . $fila["editorial"] . "</td>
                        <td>" . $fila["autor"] . "</td>
                        <td>" . $fila["precio"] . "</td>
                        <td>" . $fila["stock"] . "</td>
                    </tr>";
                }
            }else{
                echo "<tr><td colspan='5'>No hay resultados</td></tr>";
            }
            $conexion->close();
        ?>
    </table>
</body>
</html>
