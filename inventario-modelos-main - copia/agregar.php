<?php
// Activar visualización de errores (solo para desarrollo)
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/includes/conexion.php';
require_once __DIR__ . '/includes/header.php';

// Inicializar variables
$error = null;
$success = null;

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $cantidad = trim($_POST['cantidad'] ?? '');
    $categoria = $_POST['categoria'] ?? null;
    
    // Validaciones
    if (empty($nombre) || empty($cantidad) || empty($categoria)) {
        $error = "Todos los campos son obligatorios";
    } elseif (!is_numeric($categoria)) {
        $error = "Categoría inválida";
    } else {
        try {
            // Consulta preparada para seguridad
            $sql = "INSERT INTO ingrediente (name, cantidad, id_categoria) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nombre, $cantidad, $categoria]);
            
            $success = "Ingrediente agregado correctamente";
            // Limpiar campos después de éxito
            $nombre = $cantidad = '';
        } catch (PDOException $e) {
            $error = "Error al agregar: " . $e->getMessage();
        }
    }
}

// Obtener categorías para el select
$categorias = $conn->query("SELECT * FROM categoria")->fetchAll();
?>

<h2>Agregar Nuevo Ingrediente</h2>

<?php if ($error): ?>
<div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<?php if ($success): ?>
<div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>

<form method="post">
    <div class="mb-3">
        <label class="form-label">Nombre *</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($nombre ?? '') ?>" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Cantidad *</label>
        <input type="text" name="cantidad" value="<?= htmlspecialchars($cantidad ?? '') ?>" class="form-control" required>
        <small class="text-muted">Ejemplo: 500 g, 1 kg, 10 unidades</small>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Categoría *</label>
        <select name="categoria" class="form-select" required>
            <option value="">Seleccione una categoría</option>
            <?php foreach ($categorias as $cat): ?>
            <option value="<?= $cat['id'] ?>" <?= ($categoria ?? '') == $cat['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat['categoriaName']) ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php require_once __DIR__ . '/includes/footer.php'; ?>