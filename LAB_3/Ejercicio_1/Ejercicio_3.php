<?php
include('conexion.php');
$sql = "SELECT 
            SUM(CASE WHEN sexo = 'M' THEN 1 ELSE 0 END) AS total_varones, 
            SUM(CASE WHEN sexo = 'F' THEN 1 ELSE 0 END) AS total_mujeres 
        FROM alumnos";

$resultado = $con->query($sql);
$fila = $resultado->fetch_assoc();
$total_varones = $fila['total_varones'];
$total_mujeres = $fila['total_mujeres'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Alumnos por Sexo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #003366; 
            color: white; 
        }
        .icono {
            width: 20px;
            height: 20px;
            vertical-align: middle;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Total Alumnos por Sexo</h2>
    <table>
        <tr>
            <th>Total Varones</th>
            <td>
                <img src="../images/joven-argentino-aislado-fondo-blanco-brazos-cruzados-mirando-adelante_1368-336251.jpg   " class="icono" alt="Varones"> 
                <?php echo $total_varones; ?>
            </td>
        </tr>
        <tr>
            <th>Total Mujeres</th>
            <td>
                <img src="../images/photo-1621784562877-e971f1f79f47.jpg" class="icono" alt="Mujeres">
                <?php echo $total_mujeres; ?>
            </td>
        </tr>
    </table>
</body>
</html>
