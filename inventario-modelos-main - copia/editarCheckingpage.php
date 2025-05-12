<?php
require_once __DIR__ . '/includes/conexion.php';
require_once __DIR__ . '/includes/header.php';

// Validar que se reciba un ID válido
if (!isset($_GET['id_checking']) || !is_numeric($_GET['id_checking'])) {
    header('Location: checking.php?error=1');
    exit();
}

$id_checking = $_GET['id_checking'];

// Obtener los datos del checking a editar
try {
    $query = "SELECT * FROM checking WHERE id_checking = :id_checking";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_checking', $id_checking, PDO::PARAM_INT);
    $stmt->execute();
    $checking = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$checking) {
        header('Location: checking.php?error=2');
        exit();
    }
} catch (PDOException $e) {
    die("Error al consultar el checking: " . $e->getMessage());
}

// Procesar el formulario de edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha_entrega = $_POST['fecha_entrega'];

    try {
        $query = "UPDATE checking SET fecha_entrega = :fecha_entrega WHERE id_checking = :id_checking";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':fecha_entrega', $fecha_entrega);
        $stmt->bindParam(':id_checking', $id_checking, PDO::PARAM_INT);
        $stmt->execute();

        // Redirigir con mensaje de éxito
        header('Location: checking.php?success=updated');
        exit();
    } catch (PDOException $e) {
        die("Error al actualizar el checking: " . $e->getMessage());
    }
}
?>

<h2 class="text-center">Editar Checking</h2>
<form method="POST" action="editarCheckingpage.php?id_checking=<?= $id_checking ?>" class="mt-4">
    <div class="mb-3">
        <label for="fecha_entrega" class="form-label">Fecha de Entrega</label>
        <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" value="<?= htmlspecialchars($checking['fecha_entrega']) ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="checking.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php require_once __DIR__ . '/includes/footer.php'; ?>