<?php
require_once BASE_DIR .  '../classes/Database.php';
require_once BASE_DIR .  '../classes/Crud.php';

$database = new Database();
$db = $database->getConnection();
$clientesCrud = new Crud($db, 'clientes');

// Determinamos qué operación se va a realizar a través de la variable 'action' enviada por POST
$action = $_POST['action'];

switch ($action) {
    case 'create':
        // Insertar un nuevo cliente
        $nuevoCliente = [
            'nombre' => $_POST['nombre'],
            'email'  => $_POST['email'],
            'telefono' => $_POST['telefono'],
            'direccion' => $_POST['direccion']
        ];
        if ($clientesCrud->create($nuevoCliente)) {
            echo "Cliente creado con éxito.";
        } else {
            echo "Error al crear cliente.";
        }
        break;

    case 'read':
        // Obtener y devolver una lista de clientes en formato HTML
        $clientes = $clientesCrud->read(); 
        if (count($clientes) > 0) {
            echo "<ul>";
            foreach ($clientes as $cliente) {
                echo "<li>Nombre: " . $cliente['nombre'] . ", Email: " . $cliente['email'] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "No hay clientes.";
        }
        break;

    case 'update':
        // Actualizar un cliente
        $id = $_POST['id'];
        $datosActualizados = [
            'nombre' => $_POST['nombre'],
            'email'  => $_POST['email'],
            'telefono' => $_POST['telefono'],
            'direccion' => $_POST['direccion']
        ];
        $condiciones = ['id' => $id];
        if ($clientesCrud->update($datosActualizados, $condiciones)) {
            echo "Cliente actualizado con éxito.";
        } else {
            echo "Error al actualizar cliente.";
        }
        break;

    case 'delete':
        // Eliminar un cliente
        $id = $_POST['id'];
        if ($clientesCrud->delete(['id' => $id])) {
            echo "Cliente eliminado con éxito.";
        } else {
            echo "Error al eliminar cliente.";
        }
        break;

    default:
        echo "Acción no válida.";
        break;
}
