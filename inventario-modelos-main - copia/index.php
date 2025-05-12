<?php
require_once __DIR__ . '/includes/conexion.php';
require_once __DIR__ . '/includes/header.php';


// Consulta para obtener todos los ingredientes con su categoría
$sql = "SELECT i.*, c.categoriaName 
        FROM ingrediente i
        LEFT JOIN categoria c ON i.id_categoria = c.id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$ingredientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Listado de Ingredientes</h2>

<!-- SOLO UN BOTÓN DE AGREGAR ARRIBA -->
<a href="agregar.php" class="btn btn-success mb-3">
    <i class="fas fa-plus"></i> Agregar Ingrediente
</a>

<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Categoría</th>
            <th>Acciones</th> <!-- Columna única para acciones -->
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ingredientes as $ingrediente): ?>
        <tr>
            <td><?= $ingrediente['id'] ?></td>
            <td><?= htmlspecialchars($ingrediente['name']) ?></td>
            <td><?= htmlspecialchars($ingrediente['cantidad']) ?></td>
            <td><?= htmlspecialchars($ingrediente['categoriaName']) ?></td>
            <td>
                <!-- BOTONES DE ACCIÓN POR FILA -->
                <a href="editar.php?id=<?= $ingrediente['id'] ?>" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit"></i> Editar
                </a>
                <a href="eliminar.php?id=<?= $ingrediente['id'] ?>" 
                   class="btn btn-sm btn-danger"
                   onclick="return confirm('¿Eliminar <?= htmlspecialchars($ingrediente['name']) ?>?')">
                    <i class="fas fa-trash"></i> Eliminar
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
// Mostrar mensajes de éxito
if (isset($_GET['success'])) {
    echo '<div class="alert alert-success">Operación realizada correctamente!</div>';
}
if (isset($_GET['deleted'])) {
    echo '<div class="alert alert-info">Ingrediente eliminado correctamente</div>';
}
?>

<?php 
require_once __DIR__ . '/includes/footer.php';
?>