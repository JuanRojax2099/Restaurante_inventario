<?php

require_once __DIR__ . '/includes/conexion.php';
require_once __DIR__ . '/includes/header.php';

// Validar que se reciba un ID válido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: checking.php?error=1');
    exit();
}

$id_checking = $_GET['id'];

// Procesar el formulario de agregar detalles
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_ingrediente = $_POST['id_ingrediente'];
    $cantidad = $_POST['cantidad'];
    $coste_total = $_POST['coste_total'];
    $provedor = $_POST['provedor'];

    try {
        // Insertar un nuevo detalle en la tabla "checking_detalle"
        $query = "INSERT INTO checking_detalle (id_checking, id_ingrediente, cantidad, coste_total, provedor)
                  VALUES (:id_checking, :id_ingrediente, :cantidad, :coste_total, :provedor)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id_checking', $id_checking, PDO::PARAM_INT);
        $stmt->bindParam(':id_ingrediente', $id_ingrediente, PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_STR);
        $stmt->bindParam(':coste_total', $coste_total, PDO::PARAM_INT);
        $stmt->bindParam(':provedor', $provedor, PDO::PARAM_INT);
        $stmt->execute();

        // Redirigir con mensaje de éxito
        header('Location: detalle_checking.php?id_checking=' . $id_checking . '&success=detalle_agregado');
        exit();
    } catch (PDOException $e) {
        die("Error al insertar el detalle: " . $e->getMessage());
    }
}
?>

<h2 class="text-center">Agregar Detalle al Checking</h2>
<form method="POST" action="agregar_detalle_checking.php?id=<?= $id_checking ?>" class="mt-4">
    <div class="mb-3">
        <label for="id_ingrediente" class="form-label">ID Ingrediente</label>
        <input type="number" class="form-control" id="id_ingrediente" name="id_ingrediente" required>
    </div>
    <div class="mb-3">
        <label for="cantidad" class="form-label">Cantidad</label>
        <input type="text" class="form-control" id="cantidad" name="cantidad" required>
    </div>
    <div class="mb-3">
        <label for="coste_total" class="form-label">Coste Total</label>
        <input type="number" class="form-control" id="coste_total" name="coste_total" required>
    </div>
    <div class="mb-3">
        <label for="provedor" class="form-label">ID Proveedor</label>
        <input type="number" class="form-control" id="provedor" name="provedor" required>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="detalle_checking.php?id_checking=<?= $id_checking ?>" class="btn btn-secondary">Cancelar</a>
</form>

<?php require_once __DIR__ . '/includes/footer.php'; ?>