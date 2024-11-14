<?php
require_once 'config.php';
header('Content-Type: application/json');

$bandeja = $_GET['bandeja'] ?? 'entrada';

$query = "SELECT * FROM correos WHERE bandeja = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $bandeja);
$stmt->execute();
$result = $stmt->get_result();
$emails = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($emails);
$stmt->close();