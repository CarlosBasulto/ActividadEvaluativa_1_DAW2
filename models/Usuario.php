<?php
require_once BASE_DIR .  '../classes/Crud.php';
require_once BASE_DIR .  '../classes/Database.php';

class Usuario {
    private $crud;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->crud = new Crud($db, 'usuarios');  // Tabla 'usuarios'
    }

    public function crearUsuario($data) {
        return $this->crud->create($data);
    }

    public function leerUsuarios($conditions = null) {
        return $this->crud->read($conditions);
    }

    public function actualizarUsuario($data, $conditions) {
        return $this->crud->update($data, $conditions);
    }

    public function eliminarUsuario($conditions) {
        return $this->crud->delete($conditions);
    }
}
?>
