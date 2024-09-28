<?php
require_once BASE_DIR .  '../controllers/UsuarioController.php';

$usuarioController = new UsuarioController();
$usuarios = $usuarioController->mostrarUsuarios();
?>

<h2>Lista de Usuarios</h2>
<ul>
<?php foreach ($usuarios as $usuario): ?>
    <li><?php echo "ID: " . $usuario['id'] . " - Nombre: " . $usuario['nombre']; ?></li>
<?php endforeach; ?>
</ul>
