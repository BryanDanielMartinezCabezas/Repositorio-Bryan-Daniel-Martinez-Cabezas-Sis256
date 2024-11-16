<?php 
include "conexion.php";

$sql = "SELECT imagen, titulo, id,autor,ideditorial,idusuario,idcarrera FROM libros";

$resultado = $con->query($sql);
if ($resultado->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Título</th>     <th>Imagen</th>  <th>autor</th>  <th>id editorial</th> <th>id usuario</th> <th>id carrera</th> </tr>";

    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila['titulo'] . "</td>";
        echo "<td><img src='images/" . $fila['imagen'] . "' alt='Imagen de " . $fila['titulo'] . "' width='100'></td>";
        echo "<td>" . $fila['autor'] . "</td>";
        echo "<td>" . $fila['ideditorial'] . "</td>";
        echo "<td>" . $fila['idusuario'] . "</td>";
        echo "<td>" . $fila['idcarrera'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No se encontraron libros.";
}

?>