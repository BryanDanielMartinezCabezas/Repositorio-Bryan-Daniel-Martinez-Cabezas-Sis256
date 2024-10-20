<?php
include('conexion.php');

$sql = "SELECT a.id, a.fotografia, a.nombres, a.apellidos, a.cu, a.sexo, c.carrera 
        FROM alumnos a 
        JOIN carreras c ON a.codigocarrera = c.codigo";

if (isset($_GET['ordenar'])) {
    $sql .= " ORDER BY " . $_GET['ordenar'];
}

$resultado = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alumnos</title>
    <style>
        table 
        {
            border-collapse: collapse;
            width: 100%;
        }

        th,td 
        {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        th 
        {
            background-color: #003366;
            color: white;
        }

        th a 
        {
            color: white;
            text-decoration: none;
        }

        .fila-par 
        {
            background-color: #f2f2f2;
        }

        .foto 
        {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <h2>Lista de Alumnos</h2>
    <table>
        <tr>
            <th>Nro</th>
            <th>Fotografia</th>
            <th><a href="?ordenar=nombres">Nombres</a></th>
            <th><a href="?ordenar=apellidos">Apellidos</a></th>
            <th><a href="?ordenar=cu">CU</a></th>
            <th><a href="?ordenar=sexo">Sexo</a></th>
            <th><a href="?ordenar=carrera">Carrera</a></th>
        </tr>
        <?php
        $contador = 1;
        while ($fila = $resultado->fetch_assoc()) {
            if ($contador % 2 == 0) {
                $class = 'fila-par';
            } else {
                $class = '';
            }
        ?>
            <tr class="<?php echo $class; ?>">
                <td><?php echo $contador; ?></td>
                <td>
                    <?php
                    if (!empty($fila['fotografia'])) {
                        echo "<img src='../images/" . $fila['fotografia'] . "' class='foto' alt='Foto de " . $fila['nombres'] . "'>";
                    } else {
                        echo "No disponible";
                    }
                    ?>
                </td>
                <td><?php echo $fila['nombres']; ?></td>
                <td><?php echo $fila['apellidos']; ?></td>
                <td><?php echo $fila['cu']; ?></td>
                <td><?php echo ($fila['sexo'] == 'M') ? 'Masculino' : 'Femenino'; ?></td>
                <td><?php echo $fila['carrera']; ?></td>
            </tr>
        <?php
            $contador++;
        }
        ?>
    </table>
    <br>
    <a href="form_insert.php">Insertar nuevos alumnos</a>
</body>

</html>
