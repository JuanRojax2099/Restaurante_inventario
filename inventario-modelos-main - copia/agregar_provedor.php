<?php

require_once __DIR__ . '/includes/conexion.php';
require_once __DIR__ . '/includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $especialidad = $_POST['especialidad'];

    $query = "INSERT INTO provedor (nombre, especialidad) VALUES (:nombre, :especialidad)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':especialidad', $especialidad);
    $stmt->execute();

    header('Location: provedor.php?success=1');
    exit;
}
?>

<h2 class="text-center">Agregar Proveedor</h2>
<form method="POST" action="agregar_provedor.php" class="mt-4">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre del Provedor</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>
    <div class="mb-3">
        <label for="especialidad" class="form-label">Especialidad</label>
        <input type="text" class="form-control" id="especialidad" name="especialidad" required>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="provedor.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php require_once __DIR__ . '/includes/footer.php'; ?>