<?php
require_once __DIR__ . '/includes/conexion.php';
require_once __DIR__ . '/includes/header.php';

try {
    // Consulta para obtener los datos de la tabla "checking"
    $sql = "SELECT id_checking, fecha_entrega FROM checking";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $checkings = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al consultar la base de datos: " . $e->getMessage());
}
?>

<h2 class="text-center">Listado de Checkings</h2>

<!-- Botón para agregar un nuevo checking -->
<a href="agregar_checking.php" class="btn btn-success mb-3">
    <i class="fas fa-plus"></i> Agregar Checking
</a>

<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Fecha de Entrega</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($checkings as $checking): ?>
        <tr>
            <td><?= htmlspecialchars($checking['id_checking']) ?></td>
            <td><?= htmlspecialchars($checking['fecha_entrega']) ?></td>
            <td>
                <!-- Botones de acción -->
                <a href="editarcheckingpage.php?id_checking=<?= $checking['id_checking'] ?>" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit"></i> Editar
                </a>
                <a href="eliminar_checking.php?id_checking=<?= $checking['id_checking'] ?>&type=checking" 
                   class="btn btn-sm btn-danger"
                   onclick="return confirm('¿Eliminar este checking?')">
                    <i class="fas fa-trash"></i> Eliminar
                </a>
                <!-- Botón "Mostrar detalles" -->
                <a href="detalle_checking.php?id_checking=<?= $checking['id_checking'] ?>" class="btn btn-sm btn-info">
                    <i class="fas fa-eye"></i> Mostrar detalles
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
// Mostrar mensajes de éxito o error
if (isset($_GET['success'])) {
    echo '<div class="alert alert-success">Operación realizada correctamente!</div>';
}
if (isset($_GET['error'])) {
    echo '<div class="alert alert-danger">Ocurrió un error al realizar la operación.</div>';
}
?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>