<?php
require_once BASE_DIR .  '../controllers/ClienteController.php';

$clienteController = new ClienteController();
$clientes = $clienteController->mostrarClientes();
?>

<h2>Lista de Clientes</h2>
<ul>
<?php foreach ($clientes as $cliente): ?>
    <li><?php echo "ID: " . $cliente['id'] . " - Nombre: " . $cliente['nombre']; ?></li>
<?php endforeach; ?>
</ul>
