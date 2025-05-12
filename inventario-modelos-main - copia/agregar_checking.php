<?php
// Activar visualización de errores (solo para desarrollo)
require_once __DIR__ . '/includes/conexion.php';
require_once __DIR__ . '/includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha_entrega = $_POST['fecha_entrega'];

    try {
        // Insertar un nuevo registro en la tabla "checking"
        $query = "INSERT INTO checking (fecha_entrega) VALUES (:fecha_entrega)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':fecha_entrega', $fecha_entrega);
        $stmt->execute();

        // Redirigir con mensaje de éxito
        header('Location: checking.php?success=1');
        exit;
    } catch (PDOException $e) {
        die("Error al insertar el registro: " . $e->getMessage());
    }
}
?>

<h2 class="text-center">Agregar Checking</h2>
<form method="POST" action="agregar_checking.php" class="mt-4">
    <div class="mb-3">
        <label for="fecha_entrega" class="form-label">Fecha de Entrega</label>
        <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" required>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="checking.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php require_once __DIR__ . '/includes/footer.php'; ?>