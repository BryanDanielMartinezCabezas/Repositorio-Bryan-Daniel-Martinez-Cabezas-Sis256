<?php
require_once 'config.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'error' => 'Datos inválidos']);
    exit;
}

$query = "INSERT INTO correos (bandeja, correo, asunto, mensaje, estado) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($query);

if (!$stmt) {
    echo json_encode(['success' => false, 'error' => 'Error al preparar la consulta']);
    exit;
}

$bandeja = 'salida';
$estado = 'P';
$stmt->bind_param("sssss", $bandeja, $data['correo'], $data['asunto'], $data['mensaje'], $estado);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Error al ejecutar la consulta']);
}

$stmt->close();
?>
