<?php

require_once __DIR__ . '/includes/conexion.php';
require_once __DIR__ . '/includes/header.php';

$id = $_GET['id'];

// Obtener los datos del proveedor a editar
$query = "SELECT * FROM provedor WHERE id_provedor = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$provedor = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$provedor) {
    die("Proveedor no encontrado.");
}

// Procesar el formulario de edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevo_id = $_POST['id_provedor'];
    $nombre = $_POST['nombre'];
    $especialidad = $_POST['especialidad'];

    // Actualizar los datos del proveedor
    $query = "UPDATE provedor SET id_provedor = :nuevo_id, nombre = :nombre, especialidad = :especialidad WHERE id_provedor = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':nuevo_id', $nuevo_id, PDO::PARAM_INT);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':especialidad', $especialidad);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: provedor.php?updated=1');
    exit;
}
?>

<h2 class="text-center">Editar Proveedor</h2>
<form method="POST" action="editar_provedor.php?id=<?= $id ?>" class="mt-4">
    <div class="mb-3">
        <label for="id_provedor" class="form-label">ID del Proveedor</label>
        <input type="number" class="form-control" id="id_provedor" name="id_provedor" value="<?= htmlspecialchars($provedor['id_provedor']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre del Proveedor</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($provedor['nombre']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="especialidad" class="form-label">Especialidad</label>
        <input type="text" class="form-control" id="especialidad" name="especialidad" value="<?= htmlspecialchars($provedor['especialidad']) ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="provedor.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php require_once __DIR__ . '/includes/footer.php'; ?>