<?php
// Activar visualización de errores (solo para desarrollo)
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/includes/conexion.php';

// Verificar método y permisos (ejemplo básico)
if ($_SERVER['REQUEST_METHOD'] !== 'GET' || !isset($_GET['id'])) {
    header("Location: index.php?error=1");
    exit();
}

// Validar ID
$id = $_GET['id'];
if (!is_numeric($id)) {
    header("Location: index.php?error=2");
    exit();
}

try {
    // Primero verificar que existe el ingrediente
    $stmt = $conn->prepare("SELECT name FROM ingrediente WHERE id = ?");
    $stmt->execute([$id]);
    $ingrediente = $stmt->fetch();
    
    if (!$ingrediente) {
        header("Location: index.php?error=3");
        exit();
    }
    
    // Eliminar usando consulta preparada
    $stmt = $conn->prepare("DELETE FROM ingrediente WHERE id = ?");
    $stmt->execute([$id]);
    
    // Redirigir con mensaje de éxito
    header("Location: index.php?success=eliminado&nombre=" . urlencode($ingrediente['name']));
    exit();
    
} catch (PDOException $e) {
    // Registrar error y redirigir
    error_log("Error al eliminar: " . $e->getMessage());
    header("Location: index.php?error=4");
    exit();
}