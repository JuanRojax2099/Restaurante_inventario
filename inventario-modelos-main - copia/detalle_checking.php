<?php
// Activar visualización de errores (solo para desarrollo)
require_once __DIR__ . '/includes/conexion.php';
require_once __DIR__ . '/includes/header.php';

// Validar que se reciba un ID válido
if (!isset($_GET['id_checking']) || !is_numeric($_GET['id_checking'])) {
    header('Location: checking.php?error=1'); // Redirigir si no hay un ID válido
    exit();
}

$id_checking = $_GET['id_checking'];

// Obtener los detalles relacionados con el ID del checking
try {
    $detalleQuery = "SELECT cd.id_checking, cd.id_ingrediente, cd.cantidad, cd.coste_total, p.nombre AS proveedor
                     FROM checking_detalle cd
                     LEFT JOIN provedor p ON cd.provedor = p.id_provedor
                     WHERE cd.id_checking = :id_checking";
    $detalleStmt = $conn->prepare($detalleQuery);
    $detalleStmt->bindParam(':id_checking', $id_checking, PDO::PARAM_INT);
    $detalleStmt->execute();
    $detalles = $detalleStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al consultar los detalles: " . $e->getMessage());
}
?>

<h2 class="text-center">Detalles del Checking</h2>

<?php if (count($detalles) > 0): ?>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID Checking</th>
                <th>ID Ingrediente</th>
                <th>Cantidad</th>
                <th>Coste Total</th>
                <th>Proveedor</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detalles as $detalle): ?>
            <tr>
                <td><?= htmlspecialchars($detalle['id_checking']) ?></td>
                <td><?= htmlspecialchars($detalle['id_ingrediente']) ?></td>
                <td><?= htmlspecialchars($detalle['cantidad']) ?></td>
                <td><?= htmlspecialchars($detalle['coste_total']) ?></td>
                <td><?= htmlspecialchars($detalle['proveedor']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="text-center">No hay detalles disponibles para este checking.</p>
    <a href="agregar_detalle_checking.php?id=<?= $id_checking ?>" class="btn btn-primary">Agregar detalles</a>
<?php endif; ?>

<a href="checking.php" class="btn btn-secondary mt-3">Volver</a>

<?php require_once __DIR__ . '/includes/footer.php'; ?>