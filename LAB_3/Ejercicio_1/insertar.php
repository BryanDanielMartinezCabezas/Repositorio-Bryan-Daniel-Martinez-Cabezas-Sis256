<?php
include("conexion.php");

for ($i = 1; $i <= 4; $i++) {
    $fotografia = '';


    $archivo_original = $_FILES["fotografia$i"]["name"];
    $arreglo = explode(".", $archivo_original);
    $extension = end($arreglo);
    $fotografia = uniqid() . "." . $extension;

    if (!copy($_FILES["fotografia$i"]["tmp_name"], "../images/$fotografia")) {
        echo "Error al subir la imagen $fotografia<br>";
    }

    $nombres = $_POST["nombres$i"];
    $apellidos = $_POST["apellidos$i"];
    $cu = $_POST["cu$i"];
    $sexo = $_POST["sexo$i"];
    $codigocarrera = $_POST["carrera$i"];

    $sql = "INSERT INTO alumnos (fotografia, nombres, apellidos, cu, sexo, codigocarrera) 
            VALUES ('$fotografia', '$nombres', '$apellidos', '$cu', '$sexo', '$codigocarrera')";

    $resultado = $con->query($sql);
}

if ($resultado) {
?>
    <h1>Datos insertados correctamente</h1>
    <meta http-equiv="refresh" content="3; url=read.php">
<?php
} else {
    echo "Error al insertar los datos";
}
?>