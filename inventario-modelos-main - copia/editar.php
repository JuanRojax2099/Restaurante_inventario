<?php
// Activar visualización de errores (solo para desarrollo)
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/includes/conexion.php';
require_once __DIR__ . '/includes/header.php';

// Validación más robusta del ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// Consulta preparada para seguridad
$stmt = $conn->prepare("SELECT * FROM ingrediente WHERE id = ?");
$stmt->execute([$id]);
$ingrediente = $stmt->fetch();

// Verificar si se encontró el ingrediente
if (!$ingrediente) {
    die("<div class='alert alert-danger'>Ingrediente no encontrado</div>");
}

// Procesamiento del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $cantidad = $_POST['cantidad'] ?? '';
    $categoria = $_POST['categoria'] ?? '';
    
    try {
        $sql = "UPDATE ingrediente SET name = ?, cantidad = ?, id_categoria = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nombre, $cantidad, $categoria, $id]);
        
        header("Location: index.php?success=1");
        exit();
    } catch (PDOException $e) {
        $error = "Error al actualizar: " . $e->getMessage();
    }
}

// Obtener categorías para el select
$categorias = $conn->query("SELECT * FROM categoria")->fetchAll();
?>

<h2>Editar Ingrediente: <?= htmlspecialchars($ingrediente['name']) ?></h2>

<?php if (isset($error)): ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="post">
    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($ingrediente['name']) ?>" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Cantidad</label>
        <input type="text" name="cantidad" value="<?= htmlspecialchars($ingrediente['cantidad']) ?>" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Categoría</label>
        <select name="categoria" class="form-select" required>
            <?php foreach ($categorias as $cat): ?>
            <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $ingrediente['id_categoria'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat['categoriaName']) ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
<?php


require_once __DIR__ . '/includes/conexion.php';
require_once __DIR__ . '/includes/header.php';

$id = $_GET['id'];
$query = "SELECT * FROM provedor WHERE id_provedor = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();
$provedor = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $especialidad = $_POST['especialidad'];

    $query = "UPDATE provedor SET nombre = :nombre, especialidad = :especialidad WHERE id_provedor = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':especialidad', $especialidad);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header('Location: provedor.php?updated=1');
    exit;
}
?>
