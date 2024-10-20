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

ht
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alumnos</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #003366;
            color: white; 
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .foto {
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
            <th><a href="?ordenar=nombres" style="color: white;">Nombres</a></th>
            <th><a href="?ordenar=apellidos" style="color: white;">Apellidos</a></th>
            <th><a href="?ordenar=cu" style="color: white;">CU</a></th>
            <th><a href="?ordenar=sexo" style="color: white;">Sexo</a></th>
            <th><a href="?ordenar=carrera" style="color: white;">Carrera</th>
        </tr>
        <?php 
        $contador = 1;
        while ($fila = $resultado->fetch_assoc()) { 
        ?>
        <tr>
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

<?php
$con->close();
?>
