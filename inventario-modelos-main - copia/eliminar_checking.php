<?php

require_once __DIR__ . '/includes/conexion.php';

// Validar que se reciba un ID válido
if (!isset($_GET['id_checking']) || !is_numeric($_GET['id_checking'])) {
    header('Location: checking.php?error=1'); // Error: ID no válido
    exit();
}

$id_checking = $_GET['id_checking'];

try {
    // Eliminar el registro de la tabla "checking"
    $query = "DELETE FROM checking WHERE id_checking = :id_checking";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_checking', $id_checking, PDO::PARAM_INT);
    $stmt->execute();

    // Redirigir con mensaje de éxito
    header('Location: checking.php?success=eliminado');
    exit();
} catch (PDOException $e) {
    // Registrar error y redirigir con mensaje de error
    error_log("Error al eliminar el checking: " . $e->getMessage());
    header('Location: checking.php?error=2'); // Error al eliminar
    exit();
}
?>