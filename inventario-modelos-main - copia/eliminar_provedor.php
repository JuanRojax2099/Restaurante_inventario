<?php
// editar_provedor.php
require_once __DIR__ . '/includes/conexion.php';

$id = $_GET['id'];

// Eliminar el proveedor
$query = "DELETE FROM provedor WHERE id_provedor = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

header('Location: provedor.php?deleted=1');
exit;
?>