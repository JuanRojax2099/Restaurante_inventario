<?php
require_once __DIR__ . '/includes/header.php'; // Asegúrate de usar el encabezado correcto
require_once __DIR__ . '/includes/conexion.php'; // Asegúrate de usar la conexión centralizada

// Selecciona la base de datos "inventario"
$conn->exec("USE inventario");

// Consulta para obtener los datos de la tabla "provedor"
$query = "SELECT id_provedor, nombre, especialidad FROM provedor";
$stmt = $conn->query($query); // Usa la conexión `$conn` de `conexion.php`
$provedores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2 class="text-center">Listado de Provedores</h2>

<!-- Botón para agregar un nuevo provedor -->
<a href="agregar_provedor.php" class="btn btn-success mb-3">
    <i class="fas fa-plus"></i> Agregar Provedor
</a>

<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Contacto</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($provedores as $provedor): ?>
        <tr>
            <td><?= htmlspecialchars($provedor['id_provedor']) ?></td>
            <td><?= htmlspecialchars($provedor['nombre']) ?></td>
            <td><?= htmlspecialchars($provedor['especialidad']) ?></td>
            <td>
                <!-- Botones de acción -->
                <a href="editar_provedor.php?id=<?= $provedor['id_provedor'] ?>" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit"></i> Editar
                </a>
                <a href="eliminar_provedor.php?id=<?= $provedor['id_provedor'] ?>" 
                   class="btn btn-sm btn-danger"
                   onclick="return confirm('¿Eliminar <?= htmlspecialchars($provedor['nombre']) ?>?')">
                    <i class="fas fa-trash"></i> Eliminar
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php require_once __DIR__ . '/includes/footer.php'; ?>

