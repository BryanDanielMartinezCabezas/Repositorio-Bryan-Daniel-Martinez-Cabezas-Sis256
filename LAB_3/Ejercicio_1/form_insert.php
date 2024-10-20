<?php include('conexion.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Insertar Alumnos</title>
    <style>
        table 
        { border-collapse: collapse; width: 100%; }
        th, td 
        
        { border: 1px solid black; padding: 5px; text-align: left; }
    </style>
</head>
<body>
    <h2>Insertar Alumnos</h2>
    <form method="post" action="insertar.php" enctype="multipart/form-data">
        <table>
            <tr>
                <th>Fotografía</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>CU</th>
                <th>Sexo</th>
                <th>Carrera</th>
            </tr>
            <?php 
            
            for ($i = 1; $i <= 4; $i++) { ?>
            <tr>
                <td><input type="file" name="fotografia<?php echo $i; ?>" ></td>
                <td><input type="text" name="nombres<?php echo $i; ?>"></td>
                <td><input type="text" name="apellidos<?php echo $i; ?>" ></td>
                <td><input type="text" name="cu<?php echo $i; ?>" ></td>
                <td>
                    <input type="radio" name="sexo<?php echo $i; ?>" value="M"> Masculino
                    <input type="radio" name="sexo<?php echo $i; ?>" value="F"> Femenino
                </td>
                <td>
                    <select name="carrera<?php echo $i; ?>">
                        <option value="1">Ing. Sistemas</option>
                        <option value="2">Ing. Ciencias de la Computación</option>
                    </select>
                </td>
            </tr>
            <?php } ?>
        </table>
        <input type="submit" value="Insertar">
        <input type="reset" value="Borrar">
    </form>
</body>
</html>