<?php
require_once BASE_DIR .  '../classes/Crud.php';
require_once BASE_DIR .  '../classes/Database.php';

class Cliente {
    private $crud;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->crud = new Crud($db, 'clientes');  // Tabla 'clientes'
    }

    public function crearCliente($data) {
        return $this->crud->create($data);
    }

    public function leerClientes($conditions = null) {
        return $this->crud->read($conditions);
    }

    public function actualizarCliente($data, $conditions) {
        return $this->crud->update($data, $conditions);
    }

    public function eliminarCliente($conditions) {
        return $this->crud->delete($conditions);
    }
}
?>
