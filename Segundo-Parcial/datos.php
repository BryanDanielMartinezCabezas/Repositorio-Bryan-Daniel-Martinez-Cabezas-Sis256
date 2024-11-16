<?php

include("conexion.php");

$sql="SELECT titulo, imagen FROM libros";
$resultado=$con->query($sql);

$libros=[];

 while($fila=$resultado->fetch_assoc()) 
    {
        $libros[]=$fila;
     }
echo json_encode($libros, JSON_UNESCAPED_UNICODE);

?>