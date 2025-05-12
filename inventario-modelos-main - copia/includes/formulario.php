<?php
require_once '../includes/db.php';
require_once '../includes/header.php';

// Procesar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $categoria = $_POST['categoria'];
    
    try {
        $sql = "INSERT INTO ingrediente (name, cantidad, id_categoria) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nombre, $cantidad, $categoria]);
        
        header("Location: listar.php?success=1");
        exit();
    } catch (PDOException $e) {
        $error = "Error al agregar ingrediente: " . $e->getMessage();
    }
}

// Obtener categorías para el select
$categorias = $conn->query("SELECT * FROM categoria")->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Agregar Nuevo Ingrediente</h2>

<?php if (isset($error)): ?>
<div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<form method="post">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>
    
    <div class="mb-3">
        <label for="cantidad" class="form-label">Cantidad</label>
        <input type="text" class="form-control" id="cantidad" name="cantidad" required>
        <div class="form-text">Ejemplo: 500 g, 1 kg, 10 unidades</div>
    </div>
    
    <div class="mb-3">
        <label for="categoria" class="form-label">Categoría</label>
        <select class="form-select" id="categoria" name="categoria" required>
            <option value="">Seleccione una categoría</option>
            <?php foreach ($categorias as $categoria): ?>
            <option value="<?php echo $categoria['id']; ?>">
                <?php echo htmlspecialchars($categoria['categoriaName']); ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="listar.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php require_once '../includes/footer.php'; ?> 
