<td>
    <a href="editar.php?id=<?= $ingrediente['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
    <a href="eliminar.php?id=<?= $ingrediente['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este ingrediente?')">Eliminar</a>
</td>